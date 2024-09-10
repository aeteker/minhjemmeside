document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('nav a');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            if (href.startsWith('#')) {
                // For interne links med ID'er
                e.preventDefault();

                // Hent ID fra href-attributten
                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    const headerHeight = 50; // Juster denne til den præcise højde af din header

                    // Beregn det præcise top offset i forhold til dokumentet
                    const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                    const offsetPosition = elementPosition - headerHeight;

                    // Scroll til den beregnede position
                    window.scrollTo({
                        top: offsetPosition - 100,
                        behavior: 'smooth'
                    });
                }
            } else {
                // For eksterne links eller links til andre sider
                window.location.href = href;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Vælg alle elementer, der skal animeres
    const scrollElements = document.querySelectorAll('.fade-in');

    // Funktion til at tjekke, om element er i synsfeltet
    const elementInView = (el, offset = 1) => {
        const elementTop = el.getBoundingClientRect().top;

        return (
            elementTop <=
            (window.innerHeight || document.documentElement.clientHeight) / offset
        );
    };

    // Funktion til at tilføje 'visible'-klassen
    const displayScrollElement = (element) => {
        element.classList.add('visible');
    };

    // Funktion til at fjerne 'visible'-klassen, hvis ønsket
    const hideScrollElement = (element) => {
        element.classList.remove('visible');
    };

    // Håndter animation ved scroll
    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el, 1.25)) {
                displayScrollElement(el);
            } else {
                hideScrollElement(el); // Hvis du ønsker at fjerne animationen, når elementet scroller ud
            }
        });
    };

    // Lyt til scroll-begivenheden
    window.addEventListener('scroll', () => {
        handleScrollAnimation();
    });

    // Initial kald for at vise elementer, der allerede er i synsfeltet
    handleScrollAnimation();
});
