(function () {
  const header = document.querySelector(".site-header");
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const navCollapse = document.querySelector(".navbar-collapse");
  const sections = document.querySelectorAll("main section[id]");
  const backToTop = document.querySelector(".back-to-top");
  const testimonialsSlider = document.querySelector(".testimonials-slider");
  const reviewsSlider = document.querySelector(".reviews-slider-custom");
  const portfolioSlider = document.querySelector(".portfolio-slider");
  const portfolioFilterButtons = document.querySelectorAll(".portfolio-tabs button");
  const deviceButtons = document.querySelectorAll(".device-tabs button");

  document
    .querySelectorAll(
      [
        "main section:not(.hero-section) .eyebrow",
        "main section:not(.hero-section) .section-title",
        "main section:not(.hero-section) .muted",
        ".stat-item",
        ".industry-grid > div",
        ".cta-banner",
        ".service-card",
        ".client-logo-card",
        ".project-card",
        ".accordion-item",
        ".contact-form",
        ".contact-card",
        ".footer-about",
        ".footer-links",
        ".footer-contact-social",
        ".footer-bottom"
      ].join(", ")
    )
    .forEach((item, index) => {
      if (!item.classList.contains("reveal") && !item.closest(".hero-section")) {
        item.classList.add("reveal");
        item.style.transitionDelay = `${Math.min(index % 4, 3) * 0.08}s`;
      }
    });

  const revealItems = document.querySelectorAll(".reveal");

  function updateHeader() {
    header.classList.toggle("scrolled", window.scrollY > 20);
  }

  function updateBackToTop() {
    if (backToTop) {
      backToTop.classList.toggle("is-visible", window.scrollY > 420);
    }
  }

  updateHeader();
  updateBackToTop();
  window.addEventListener("scroll", updateHeader, { passive: true });
  window.addEventListener("scroll", updateBackToTop, { passive: true });

  if (backToTop) {
    backToTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  let portfolioSwiper = null;

  if (testimonialsSlider && window.Swiper) {
    new window.Swiper(testimonialsSlider, {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 28,
      speed: 650,
      grabCursor: true,
      autoplay: {
        delay: 4200,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
      },
      keyboard: {
        enabled: true
      },
      pagination: {
        el: ".testimonial-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".testimonial-next",
        prevEl: ".testimonial-prev"
      }
    });
  }

  if (reviewsSlider) {
    const track = reviewsSlider.querySelector(".reviews-track");
    const slides = Array.from(track.querySelectorAll(".reviews-slide"));
    const prevBtn = document.querySelector(".review-prev");
    const nextBtn = document.querySelector(".review-next");
    const paginationContainer = document.querySelector(".review-pagination");

    if (slides.length > 0) {
      const N = slides.length;

      // 1. Measure layout values once (dynamically)
      let w_inactive = 246;
      let w_active = 320;
      
      const testSlide = slides[0];
      const wasActive = testSlide.classList.contains("active");
      
      testSlide.classList.add("active");
      w_active = testSlide.offsetWidth || 320;
      
      testSlide.classList.remove("active");
      w_inactive = testSlide.offsetWidth || 246;
      
      if (wasActive) {
        testSlide.classList.add("active");
      }

      // 2. Clone slides: group A (prepended) and group C (appended)
      const clonesBefore = slides.map(s => s.cloneNode(true));
      const clonesAfter = slides.map(s => s.cloneNode(true));

      clonesBefore.forEach(clone => {
        clone.classList.add("is-clone");
        track.insertBefore(clone, track.firstChild);
      });

      clonesAfter.forEach(clone => {
        clone.classList.add("is-clone");
        track.appendChild(clone);
      });

      const allSlides = Array.from(track.querySelectorAll(".reviews-slide"));
      
      // Set uniform spacing on all slides
      const spaceBetween = window.innerWidth >= 992 ? 28 : 16;
      allSlides.forEach(slide => {
        slide.style.marginRight = `${spaceBetween}px`;
      });

      let currentIndex = N;
      let isTransitioning = false;
      let autoplayInterval = null;

      // Create pagination bullets
      if (paginationContainer) {
        paginationContainer.innerHTML = "";
        for (let i = 0; i < N; i++) {
          const bullet = document.createElement("button");
          bullet.className = "review-bullet" + (i === 0 ? " active" : "");
          bullet.type = "button";
          bullet.setAttribute("aria-label", `Go to slide ${i + 1}`);
          bullet.dataset.index = i;
          bullet.addEventListener("click", () => {
            goToSlide(N + i);
          });
          paginationContainer.appendChild(bullet);
        }
      }

      function updateActiveSlide(index) {
        allSlides.forEach((slide, idx) => {
          if (idx === index) {
            slide.classList.add("active");
          } else {
            slide.classList.remove("active");
          }
        });

        const originalIndex = (index - N + N) % N;
        if (paginationContainer) {
          const bullets = paginationContainer.querySelectorAll(".review-bullet");
          bullets.forEach((bullet, idx) => {
            if (idx === originalIndex) {
              bullet.classList.add("active");
            } else {
              bullet.classList.remove("active");
            }
          });
        }
      }

      function getTranslateXForIndex(index) {
        const containerWidth = reviewsSlider.offsetWidth;
        const currentSpace = window.innerWidth >= 992 ? 28 : 16;
        
        let slideLeft = 0;
        if (index <= currentIndex) {
          slideLeft = index * (w_inactive + currentSpace);
        } else {
          slideLeft = (index - 1) * (w_inactive + currentSpace) + (w_active + currentSpace);
        }
        
        const slideWidth = (index === currentIndex) ? w_active : w_inactive;
        
        return (containerWidth / 2) - (slideLeft + slideWidth / 2);
      }

      function setPosition(tx, animate = true) {
        if (animate) {
          track.style.transition = "transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)";
        } else {
          track.style.transition = "none";
        }
        track.style.transform = `translateX(${tx}px)`;
      }

      function goToSlide(index, animate = true) {
        if (isTransitioning && animate) return;
        
        currentIndex = index;
        if (animate) {
          isTransitioning = true;
        }
        
        updateActiveSlide(currentIndex);
        const tx = getTranslateXForIndex(currentIndex);
        setPosition(tx, animate);
      }

      // Handle loop transition resets
      track.addEventListener("transitionend", (e) => {
        // Ensure transition events from child elements (like avatar/card width changes) do not trigger this
        if (e.target !== track || e.propertyName !== "transform") return;
        
        isTransitioning = false;

        if (currentIndex < N) {
          goToSlide(currentIndex + N, false);
        } else if (currentIndex >= 2 * N) {
          goToSlide(currentIndex - N, false);
        }
      });

      if (prevBtn) {
        prevBtn.addEventListener("click", () => {
          if (isTransitioning) return;
          resetAutoplay();
          goToSlide(currentIndex - 1);
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener("click", () => {
          if (isTransitioning) return;
          resetAutoplay();
          goToSlide(currentIndex + 1);
        });
      }

      function startAutoplay() {
        if (autoplayInterval) return;
        autoplayInterval = setInterval(() => {
          goToSlide(currentIndex + 1);
        }, 3600);
      }

      function stopAutoplay() {
        if (autoplayInterval) {
          clearInterval(autoplayInterval);
          autoplayInterval = null;
        }
      }

      function resetAutoplay() {
        stopAutoplay();
        startAutoplay();
      }

      reviewsSlider.addEventListener("mouseenter", stopAutoplay);
      reviewsSlider.addEventListener("mouseleave", startAutoplay);

      window.addEventListener("keydown", (e) => {
        if (e.key === "ArrowLeft") {
          const rect = reviewsSlider.getBoundingClientRect();
          if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
            resetAutoplay();
            goToSlide(currentIndex - 1);
          }
        } else if (e.key === "ArrowRight") {
          const rect = reviewsSlider.getBoundingClientRect();
          if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
            resetAutoplay();
            goToSlide(currentIndex + 1);
          }
        }
      });

      // Drag / Swipe Gestures
      let startX = 0;
      let currentX = 0;
      let isDragging = false;
      let startTx = 0;

      function getEventX(e) {
        return e.type.includes("touch") ? e.touches[0].clientX : e.clientX;
      }

      function onDragStart(e) {
        if (e.type === "mousedown" && e.button !== 0) return;
        
        isDragging = true;
        startX = getEventX(e);
        currentX = startX;
        startTx = getTranslateXForIndex(currentIndex);
        
        stopAutoplay();
        track.style.transition = "none";
        
        if (e.type === "mousedown") {
          e.preventDefault();
        }
      }

      function onDragMove(e) {
        if (!isDragging) return;
        currentX = getEventX(e);
        const deltaX = currentX - startX;
        track.style.transform = `translateX(${startTx + deltaX}px)`;
      }

      function onDragEnd() {
        if (!isDragging) return;
        isDragging = false;
        
        const deltaX = currentX - startX;
        const threshold = 50;
        
        if (deltaX < -threshold) {
          goToSlide(currentIndex + 1);
        } else if (deltaX > threshold) {
          goToSlide(currentIndex - 1);
        } else {
          goToSlide(currentIndex);
        }
        
        startAutoplay();
      }

      reviewsSlider.addEventListener("mousedown", onDragStart);
      window.addEventListener("mousemove", onDragMove);
      window.addEventListener("mouseup", onDragEnd);

      reviewsSlider.addEventListener("touchstart", onDragStart, { passive: true });
      reviewsSlider.addEventListener("touchmove", onDragMove, { passive: true });
      reviewsSlider.addEventListener("touchend", onDragEnd);

      // Handle window resize to recalculate slider layout
      window.addEventListener("resize", () => {
        const currentSpace = window.innerWidth >= 992 ? 28 : 16;
        allSlides.forEach(slide => {
          slide.style.marginRight = `${currentSpace}px`;
        });
        
        // Recalculate measured active/inactive widths if necessary
        const wasActive = testSlide.classList.contains("active");
        testSlide.classList.add("active");
        w_active = testSlide.offsetWidth || 320;
        testSlide.classList.remove("active");
        w_inactive = testSlide.offsetWidth || 246;
        if (wasActive) {
          testSlide.classList.add("active");
        }
        
        goToSlide(currentIndex, false);
      });

      // Initial placement
      setTimeout(() => {
        goToSlide(currentIndex, false);
        startAutoplay();
      }, 150);
    }
  }

  if (portfolioSlider && window.Swiper) {
    portfolioSwiper = new window.Swiper(portfolioSlider, {
      loop: false,
      spaceBetween: 24,
      speed: 650,
      grabCursor: true,
      autoplay: {
        delay: 3200,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
      },
      keyboard: {
        enabled: true
      },
      pagination: {
        el: ".portfolio-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".portfolio-next",
        prevEl: ".portfolio-prev"
      },
      breakpoints: {
        0: {
          slidesPerView: 1
        },
        768: {
          slidesPerView: 2
        },
        1200: {
          slidesPerView: 3
        }
      }
    });
  }

  function refreshPortfolioSlider() {
    if (portfolioSwiper) {
      portfolioSwiper.update();
      portfolioSwiper.slideTo(0);
    }
  }

  portfolioFilterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const filter = button.dataset.filter || "all";

      portfolioFilterButtons.forEach((item) => item.classList.remove("active"));
      button.classList.add("active");

      document.querySelectorAll(".portfolio-slider .swiper-slide").forEach((slide) => {
        const shouldShow = filter === "all" || slide.dataset.category === filter;
        slide.classList.toggle("is-filtered", !shouldShow);
      });

      refreshPortfolioSlider();
    });
  });

  deviceButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const device = button.dataset.device || "desktop";

      deviceButtons.forEach((item) => item.classList.remove("active"));
      button.classList.add("active");

      if (portfolioSlider) {
        portfolioSlider.classList.remove("preview-desktop", "preview-tablet", "preview-mobile");
        portfolioSlider.classList.add(`preview-${device}`);
      }
    });
  });

  document.querySelectorAll(".project-card").forEach((card) => {
    card.addEventListener("click", (event) => {
      if (event.target.closest("a")) {
        return;
      }

      const projectUrl = card.dataset.projectUrl;
      if (projectUrl) {
        window.location.href = projectUrl;
      }
    });
  });

  function updateActiveLink() {
    let current = "home";

    sections.forEach((section) => {
      const top = section.offsetTop - 140;
      if (window.scrollY >= top) {
        current = section.id;
      }
    });

    navLinks.forEach((link) => {
      link.classList.toggle("active", link.getAttribute("href") === `#${current}`);
    });
  }

  updateActiveLink();
  window.addEventListener("scroll", updateActiveLink, { passive: true });

  if ("IntersectionObserver" in window) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: "0px 0px -40px 0px" }
    );

    revealItems.forEach((item) => revealObserver.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add("is-visible"));
  }

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      navLinks.forEach((item) => item.classList.remove("active"));
      link.classList.add("active");

      if (navCollapse && navCollapse.classList.contains("show") && window.bootstrap) {
        window.bootstrap.Collapse.getOrCreateInstance(navCollapse).hide();
      }
    });
  });

  if (!window.bootstrap) {
    document.querySelectorAll("[data-bs-toggle='collapse']").forEach((button) => {
      const target = document.querySelector(button.getAttribute("data-bs-target"));
      const parent = button.closest(".accordion");

      button.addEventListener("click", () => {
        const isOpen = target.classList.contains("show");

        if (parent) {
          parent.querySelectorAll(".accordion-collapse.show").forEach((panel) => {
            panel.classList.remove("show");
            const trigger = parent.querySelector(`[data-bs-target="#${panel.id}"]`);
            if (trigger) {
              trigger.classList.add("collapsed");
              trigger.setAttribute("aria-expanded", "false");
            }
          });
        }

        target.classList.toggle("show", !isOpen);
        button.classList.toggle("collapsed", isOpen);
        button.setAttribute("aria-expanded", String(!isOpen));
      });
    });
  }

  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
    });
  });
})();
