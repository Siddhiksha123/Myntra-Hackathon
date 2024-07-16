function likePost(event) {
    event.stopPropagation();
    const likesSpan = event.target.nextElementSibling;
    let likes = parseInt(likesSpan.textContent);
    likes++;
    likesSpan.textContent = likes + ' Likes';
}

function viewDetails(detailsPage) {
    window.location.href = detailsPage;
}
