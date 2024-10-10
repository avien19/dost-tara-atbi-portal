<div class="space-y-6">
    <div>
        <form id="post-form" enctype="multipart/form-data">
            @csrf
            <input type="text" id="post-title" name="title" placeholder="Enter a title..." class="w-full p-2 border rounded-md mb-2">
            <textarea id="post-content" name="content" placeholder="Start a new discussion or ask a question..." class="w-full p-2 border rounded-md"></textarea>
            <div class="flex justify-between items-center mt-2">
                <div class="space-x-2">
                    <button type="button" id="add-topic" class="px-3 py-1 text-sm bg-gray-200 rounded-md">Add Topic</button>
                    <input type="file" id="file-upload" name="photo" class="hidden">
                    <label for="file-upload" class="px-3 py-1 text-sm bg-gray-200 rounded-md cursor-pointer">Attach File</label>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Post</button>
            </div>
        </form>
    </div>
    <hr>
    <div id="posts-container" class="space-y-4">
        <!-- Posts will be dynamically added here -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('post-form');
    const postsContainer = document.getElementById('posts-container');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('{{ route("community.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.reset();
                postsContainer.insertAdjacentHTML('afterbegin', createPostHTML(data.post));
            } else {
                alert('Error creating post: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while creating the post.');
        });
    });

    function createPostHTML(post) {
        const isOwner = post.user_id === {{ auth()->id() }};
        return `
            <div class="bg-white p-4 rounded-lg shadow" data-post-id="${post.id}">
                <div class="flex items-center space-x-2 mb-2">
                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                    <div>
                        <p class="font-semibold">${post.user.name}</p>
                        <p class="text-sm text-gray-500">${new Date(post.created_at).toLocaleString()}</p>
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-2">${post.title}</h3>
                <p class="mb-4">${post.content}</p>
                ${post.photo ? `<img src="${post.photo}" alt="Post image" class="mb-4 max-w-full h-auto">` : ''}
                <div class="flex items-center space-x-4">
                    <button class="text-sm text-green-500 reply-btn">Reply</button>
                    <button class="text-sm text-green-500 like-btn">Like</button>
                    <span class="text-sm text-gray-500"><span class="replies-count">0</span> replies • <span class="likes-count">0</span> likes</span>
                    ${isOwner ? `
                        <button class="text-sm text-blue-500 edit-btn">Edit</button>
                        <button class="text-sm text-red-500 delete-btn">Delete</button>
                    ` : ''}
                </div>
                <div class="reply-form hidden mt-4">
                    <textarea class="w-full p-2 border rounded-md" placeholder="Write your reply..."></textarea>
                    <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md submit-reply">Submit Reply</button>
                </div>
                <div class="replies-container mt-4"></div>
            </div>
        `;
    }

    postsContainer.addEventListener('click', function(e) {
        const postElement = e.target.closest('[data-post-id]');
        if (!postElement) return;
        const postId = postElement.dataset.postId;

        if (e.target.classList.contains('reply-btn')) {
            const replyForm = postElement.querySelector('.reply-form');
            replyForm.classList.toggle('hidden');
        } else if (e.target.classList.contains('like-btn')) {
            likePost(postId, e.target);
        } else if (e.target.classList.contains('submit-reply')) {
            const replyContent = postElement.querySelector('.reply-form textarea').value;
            submitReply(postId, replyContent, e.target);
        } else if (e.target.classList.contains('edit-btn')) {
            editPost(postId, postElement);
        } else if (e.target.classList.contains('delete-btn')) {
            deletePost(postId, postElement);
        }
    });

    function likePost(postId, likeButton) {
        fetch(`/community/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likesCountElement = likeButton.closest('[data-post-id]').querySelector('.likes-count');
                likesCountElement.textContent = data.likesCount;
                likeButton.textContent = data.liked ? 'Unlike' : 'Like';
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function submitReply(postId, content, submitButton) {
        fetch(`/community/${postId}/reply`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ content: content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const repliesContainer = submitButton.closest('[data-post-id]').querySelector('.replies-container');
                repliesContainer.insertAdjacentHTML('beforeend', createReplyHTML(data.reply));
                submitButton.closest('.reply-form').classList.add('hidden');
                submitButton.closest('.reply-form').querySelector('textarea').value = '';
                updateRepliesCount(submitButton.closest('[data-post-id]'));
            } else {
                console.error('Error submitting reply:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function createReplyHTML(reply) {
        return `
            <div class="bg-gray-100 p-3 rounded-md mt-2">
                <p class="font-semibold">${reply.user.name}</p>
                <p>${reply.content}</p>
                <p class="text-xs text-gray-500">${new Date(reply.created_at).toLocaleString()}</p>
            </div>
        `;
    }

    function updateRepliesCount(postElement) {
        const repliesCount = postElement.querySelectorAll('.replies-container > div').length;
        postElement.querySelector('.replies-count').textContent = repliesCount;
    }

    function editPost(postId, postElement) {
        const contentElement = postElement.querySelector('p');
        const titleElement = postElement.querySelector('h3');
        const content = contentElement.textContent;
        const title = titleElement.textContent;
        const newContent = prompt('Edit your post content:', content);
        const newTitle = prompt('Edit your post title:', title);
        if ((newContent !== null && newContent !== content) || (newTitle !== null && newTitle !== title)) {
            fetch(`/community/${postId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ content: newContent, title: newTitle })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    contentElement.textContent = newContent;
                    titleElement.textContent = newTitle;
                } else {
                    console.error('Error updating post:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function deletePost(postId, postElement) {
        if (confirm('Are you sure you want to delete this post?')) {
            fetch(`/community/${postId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    postElement.remove();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Load existing posts
    fetch('{{ route("community.index") }}')
        .then(response => response.json())
        .then(data => {
            data.posts.forEach(post => {
                postsContainer.insertAdjacentHTML('beforeend', createPostHTML(post));
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while loading posts.');
        });
});
</script>