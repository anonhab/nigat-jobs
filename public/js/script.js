// Add to script.js
const modal = document.querySelector('#jobModal');
const closeBtn = document.querySelector('.close-btn');
document.querySelectorAll('.card a').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const card = e.target.closest('.card');
        document.querySelector('#modal-title').textContent = card.querySelector('h3').textContent;
        document.querySelector('#modal-company').textContent = card.querySelector('p:nth-child(2)').textContent;
        document.querySelector('#modal-type').textContent = card.querySelector('p:nth-child(3)').textContent;
        document.querySelector('#modal-salary').textContent = card.querySelector('p:nth-child(4)').textContent;
        modal.style.display = 'block';
    });
});
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});