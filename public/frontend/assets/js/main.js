(function () {
  const loader = document.querySelector(".site-loader");
  const header = document.querySelector(".site-header");
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
  const navCollapse = document.querySelector(".navbar-collapse");
  const sections = document.querySelectorAll("main section[id]");
  const backToTop = document.querySelector(".back-to-top");
  const testimonialsSlider = document.querySelector(".testimonials-slider");
  const reviewsSlider = document.querySelector(".reviews-slider-custom");
  const clientsSlider = document.querySelector(".client-logo-slider");
  const portfolioSlider = document.querySelector(".portfolio-slider");
  const servicesSlider = document.querySelector(".services-slider");
  const portfolioFilterButtons = document.querySelectorAll(".portfolio-tabs button");
  const deviceButtons = document.querySelectorAll(".device-tabs button");

  if (loader) {
    document.body.classList.add("loader-active");
    let loaderHidden = false;

    const hideLoader = () => {
      if (loaderHidden) {
        return;
      }

      loaderHidden = true;
      loader.classList.add("is-hidden");
      document.body.classList.remove("loader-active");

      setTimeout(() => {
        loader.remove();
      }, 650);
    };

    if (document.readyState === "complete") {
      setTimeout(hideLoader, 450);
    } else {
      window.addEventListener("load", () => setTimeout(hideLoader, 450), { once: true });
      setTimeout(hideLoader, 3200);
    }
  }

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
        ".contact-detail",
        ".contact-socials",
        ".contact-form-card",
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

  if (reviewsSlider && window.Swiper) {
    new window.Swiper(reviewsSlider, {
      loop: true,
      loopAdditionalSlides: 4,
      centeredSlides: false,
      slidesPerView: 1,
      initialSlide: 1,
      spaceBetween: 0,
      speed: 900,
      grabCursor: true,
      watchSlidesProgress: true,
      observer: true,
      observeParents: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: false
      },
      keyboard: {
        enabled: true
      },
      pagination: {
        el: ".review-pagination",
        clickable: true,
        bulletClass: "review-bullet",
        bulletActiveClass: "active"
      }
    });
  }

  if (servicesSlider && window.Swiper) {
    new window.Swiper(servicesSlider, {
      slidesPerView: 1,
      spaceBetween: 18,
      speed: 700,
      grabCursor: true,
      watchOverflow: true,
      pagination: {
        el: ".service-pagination",
        clickable: true,
        bulletClass: "service-bullet",
        bulletActiveClass: "active"
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 22
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 24
        }
      }
    });
  }

  if (clientsSlider && window.Swiper) {
    new window.Swiper(clientsSlider, {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 10,
      speed: 650,
      grabCursor: true,
      autoplay: {
        delay: 2600,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
      },
      pagination: {
        el: ".client-pagination",
        clickable: true,
        bulletClass: "client-bullet",
        bulletActiveClass: "active"
      },
      navigation: {
        nextEl: ".client-next",
        prevEl: ".client-prev"
      },
      breakpoints: {
        576: {
          slidesPerView: 2,
          spaceBetween: 12
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 12
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 12
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 10
        }
      }
    });
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
