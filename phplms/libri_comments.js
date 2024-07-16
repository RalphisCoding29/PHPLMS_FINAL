
function getDiscussions() {
    const storedDiscussions = localStorage.getItem('discussions');
    return storedDiscussions ? JSON.parse(storedDiscussions) : [];
}

function saveDiscussions(discussions) {
    localStorage.setItem('discussions', JSON.stringify(discussions));
}

function renderDiscussions() {
    const discussionsList = document.getElementById('discussions');
    discussionsList.innerHTML = '';

    const discussions = getDiscussions();
    discussions.forEach((discussionText, index) => {
        const discussionDiv = document.createElement('li');
        discussionDiv.classList.add('discussion');
        discussionDiv.textContent = discussionText;

        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.textContent = 'Delete Post';
        deleteBtn.onclick = function() {
            deleteDiscussion(index);
        };

        const userName = document.createElement('div');
        userName.classList.add('txt-username');
        userName.textContent = ''


        discussionDiv.appendChild(deleteBtn);
        discussionsList.appendChild(discussionDiv);
    });
}

function postDiscussion() {
    const discussionInput = document.getElementById('discussion-text');
    const discussionText = discussionInput.value.trim();

    if (discussionText !== '') {
        const discussions = getDiscussions();
        discussions.push(discussionText);
        saveDiscussions(discussions);
        renderDiscussions();
        discussionInput.value = '';
    }
}

function deleteDiscussion(index) {
    const Discussions = getDiscussions();
    Discussions.splice(index, 1);
    saveDiscussions(Discussions);
    renderDiscussions();
}

renderDiscussions();
