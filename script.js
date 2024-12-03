
        const navbar = document.querySelector('.navbar');
        const menuBtn = document.querySelector('.menu-btn');
        const closeBtn = document.querySelector('.close-btn');
        const navLinks = document.querySelector('.nav-links');

        // Scroll effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        menuBtn.addEventListener('click', () => {
            navLinks.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            navLinks.classList.remove('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navLinks.contains(e.target) && !menuBtn.contains(e.target)) {
                navLinks.classList.remove('active');
            }
        });

        // Active link handling
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', () => {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                navLinks.classList.remove('active');
            });
        });
  