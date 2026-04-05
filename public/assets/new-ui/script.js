document.addEventListener("DOMContentLoaded", function () {
    // Select all elements that should animate on scroll
    const animElements = document.querySelectorAll(
      ".animate-on-scroll, .animate-fade-in-left, .animate-fade-in-up"
    );
  
    // Observer options
    const observerOptions = {
      root: null, // use viewport
      rootMargin: "0px",
      threshold: 0.15 // trigger when 15% of element is visible
    };
  
    const intObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Add 'is-visible' class to trigger CSS animation
          entry.target.classList.add("is-visible");
          
          // Optionally stop observing once animated
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);
  
    // Start observing
    animElements.forEach((el) => {
      intObserver.observe(el);
    });
  });

// Contact Page Specific Interactivity
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('.motion-reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
            }
        });
    }, { threshold: 0.1 });

    revealElements.forEach(el => observer.observe(el));

    // Consolidated Newsletter Handling
    const newsletterForms = document.querySelectorAll('.newsletter-form');
    newsletterForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="email"]').value;
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Subscribed successfully!');
                    this.reset();
                } else {
                    alert(data.message || 'Subscription failed.');
                }
            });
        });
    });
});
