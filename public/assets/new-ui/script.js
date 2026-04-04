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
