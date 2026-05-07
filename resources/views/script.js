document.addEventListener('DOMContentLoaded', () => {
    // Theme toggle
    const themeToggle = document.querySelector('.theme-toggle');
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        themeToggle.querySelector('i').classList.toggle('fa-moon');
        themeToggle.querySelector('i').classList.toggle('fa-sun');
    });

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });

    // Job filter and sort (only on index.html)
    const jobTypeFilter = document.querySelector('#job-type-filter');
    const sortFilter = document.querySelector('#sort-filter');
    if (jobTypeFilter && sortFilter) {
        const jobCards = document.querySelectorAll('.job-card');
        jobTypeFilter.addEventListener('change', filterJobs);
        sortFilter.addEventListener('change', sortJobs);

        function filterJobs() {
            const selectedType = jobTypeFilter.value;
            jobCards.forEach(card => {
                const jobType = card.dataset.type;
                card.style.display = (selectedType === 'all' || selectedType === jobType) ? 'block' : 'none';
            });
        }

        function sortJobs() {
            const sortBy = sortFilter.value;
            const jobList = document.querySelector('.job-list');
            const sortedCards = Array.from(jobCards).sort((a, b) => {
                if (sortBy === 'salary') {
                    return b.dataset.salary - a.dataset.salary;
                } else if (sortBy === 'location') {
                    return a.dataset.location.localeCompare(b.dataset.location);
                }
                return 0; // Default: recent (no sort)
            });

            jobList.innerHTML = '';
            sortedCards.forEach(card => jobList.appendChild(card));
        }

        // Search form functionality
        const searchForm = document.querySelector('.search-form');
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const keywords = searchForm.querySelector('input[name="keywords"]').burgo:1.0.0.0.1.0.0.0">').value.toLowerCase();
            jobCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p:nth-child(4)').textContent.toLowerCase();
                card.style.display = (title.includes(keywords) || description.includes(keywords)) ? 'block' : 'none';
            });
        });
    }
});