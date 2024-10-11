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
        let repliesHTML = '';
        if (post.replies && post.replies.length > 0) {
            repliesHTML = post.replies.map(reply => createReplyHTML(reply)).join('');
        }
        const repliesCount = post.replies_count !== undefined ? post.replies_count : 0;
        
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
                    <button class="text-sm text-green-500 like-btn">${post.liked ? 'Unlike' : 'Like'}</button>
                    <span class="text-sm text-gray-500"><span class="replies-count">${repliesCount}</span> replies • <span class="likes-count">${post.likes_count || 0}</span> likes</span>
                    ${isOwner ? `
                        <button class="text-sm text-blue-500 edit-btn">Edit</button>
                        <button class="text-sm text-red-500 delete-btn">Delete</button>
                    ` : ''}
                </div>
                <div class="reply-form hidden mt-4">
                    <textarea class="w-full p-2 border rounded-md" placeholder="Write your reply..."></textarea>
                    <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md submit-reply">Submit Reply</button>
                </div>
                <div class="replies-container mt-4">
                    ${repliesHTML}
                </div>
            </div>
        `;
    }

    function createReplyHTML(reply) {
        const isOwner = reply.user_id === {{ auth()->id() }};
        return `
            <div class="bg-gray-100 p-3 rounded-md mt-2 relative" data-reply-id="${reply.id}">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">${reply.user.name}</p>
                        <p class="reply-content">${reply.content}</p>
                        <p class="text-xs text-gray-500">${new Date(reply.created_at).toLocaleString()}</p>
                    </div>
                    ${isOwner ? `
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 dropdown-toggle">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden dropdown-menu">
                                <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left edit-reply-btn">Edit</button>
                                <button class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left delete-reply-btn">Delete</button>
                            </div>
                        </div>
                    ` : ''}
                </div>
                <div class="edit-controls hidden mt-2">
                    <textarea class="w-full p-2 border rounded-md edit-reply-textarea"></textarea>
                    <div class="mt-2">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-md update-reply-btn">Update</button>
                        <button class="px-4 py-2 bg-gray-500 text-white rounded-md ml-2 cancel-edit-btn">Cancel</button>
                    </div>
                </div>
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
            const postElement = e.target.closest('[data-post-id]');
            const postId = postElement.dataset.postId;
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
                const postElement = likeButton.closest('[data-post-id]');
                const likesCountElement = postElement.querySelector('.likes-count');
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
                const postElement = submitButton.closest('[data-post-id]');
                const repliesContainer = postElement.querySelector('.replies-container');
                repliesContainer.insertAdjacentHTML('beforeend', createReplyHTML(data.reply));
                submitButton.closest('.reply-form').classList.add('hidden');
                submitButton.closest('.reply-form').querySelector('textarea').value = '';
                updateRepliesCount(postElement, data.repliesCount);
            } else {
                console.error('Error submitting reply:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateRepliesCount(postElement, count) {
        const repliesCountElement = postElement.querySelector('.replies-count');
        if (repliesCountElement) {
            repliesCountElement.textContent = count;
        }
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

    function toggleDropdown(dropdownToggle) {
        const dropdownMenu = dropdownToggle.nextElementSibling;
        dropdownMenu.classList.toggle('hidden');
    }

    function editReply(replyId, replyElement) {
        const contentElement = replyElement.querySelector('.reply-content');
        const editControls = replyElement.querySelector('.edit-controls');
        const textarea = editControls.querySelector('.edit-reply-textarea');
        
        textarea.value = contentElement.textContent.trim();
        contentElement.classList.add('hidden');
        editControls.classList.remove('hidden');
    }

    function cancelEdit(replyElement) {
        const contentElement = replyElement.querySelector('.reply-content');
        const editControls = replyElement.querySelector('.edit-controls');
        
        contentElement.classList.remove('hidden');
        editControls.classList.add('hidden');
    }

    function updateReply(replyId, content, replyElement) {
        fetch(`/community/reply/${replyId}`, {  // Update this line
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ content: content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const contentElement = replyElement.querySelector('.reply-content');
                contentElement.textContent = data.reply.content;
                cancelEdit(replyElement);
            } else {
                console.error('Error updating reply:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Update the event listener
    document.addEventListener('click', function(e) {
        if (e.target.closest('.dropdown-toggle')) {
            const dropdownToggle = e.target.closest('.dropdown-toggle');
            toggleDropdown(dropdownToggle);
        } else {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
        }

        if (e.target.closest('.edit-reply-btn')) {
            const replyElement = e.target.closest('[data-reply-id]');
            const replyId = replyElement.dataset.replyId;
            editReply(replyId, replyElement);
        }

        if (e.target.closest('.update-reply-btn')) {
            const replyElement = e.target.closest('[data-reply-id]');
            const replyId = replyElement.dataset.replyId;
            const content = replyElement.querySelector('.edit-reply-textarea').value;
            updateReply(replyId, content, replyElement);
        }

        if (e.target.closest('.cancel-edit-btn')) {
            const replyElement = e.target.closest('[data-reply-id]');
            cancelEdit(replyElement);
        }

        if (e.target.closest('.delete-reply-btn')) {
            const replyElement = e.target.closest('[data-reply-id]');
            const replyId = replyElement.dataset.replyId;
            deleteReply(replyId, replyElement);
        }
    });

    // Load existing posts
    fetch('{{ route("community.index") }}')
        .then(response => response.json())
        .then(data => {
            data.posts.forEach(post => {
                post.liked = post.likes.some(like => like.id === {{ auth()->id() }});
                postsContainer.insertAdjacentHTML('beforeend', createPostHTML(post));
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while loading posts.');
        });

    function deleteReply(replyId, replyElement) {
        if (confirm('Are you sure you want to delete this reply?')) {
            fetch(`/community/reply/${replyId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const postElement = replyElement.closest('[data-post-id]');
                    replyElement.remove();
                    updateRepliesCount(postElement, data.repliesCount);
                } else {
                    console.error('Error deleting reply:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Make sure this function is also defined
    function updateRepliesCount(postElement, count) {
        const repliesCountElement = postElement.querySelector('.replies-count');
        if (repliesCountElement) {
            repliesCountElement.textContent = count;
        }
    }
});
</script>

<style>
    .dropdown-menu {
        z-index: 10;
    }
    .dropdown-toggle:focus + .dropdown-menu,
    .dropdown-menu:hover {
        display: block;
    }
</style>