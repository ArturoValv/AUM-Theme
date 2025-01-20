//Variables
const headerHero = document.querySelector("body:has(.cover) .site-header");
const menuButton = document.querySelector("#menu-mobile");
const mainMenu = document.querySelector(".main-menu");
const subMenuToggler = document.querySelectorAll(".menu-item-has-children");
const wrappedImages = document.querySelectorAll("p img, p picture");
const showLightbox = document.querySelectorAll(
  ".pictures_carousel .lightbox-enabled"
);
const lightbox = document.querySelectorAll(
  ".pictures_carousel .lightbox-template"
);

document.addEventListener("DOMContentLoaded", () => {
  eventListeners();
  setElementWrapped();
  headerHero && headerEvents();
});

function eventListeners() {
  //Main Menu
  menuButton.addEventListener("click", toggleMenu);

  //SubMenu
  subMenuToggler.forEach((item) => {
    item.addEventListener("click", (e) => {
      toggleSubMenu(e);
    });
  });

  //Header
  window.addEventListener("scroll", headerEvents);

  //HP Lighbox
  showLightbox.forEach((element) => {
    element.addEventListener("click", (e) => {
      e.preventDefault();
      let dataId = element.getAttribute("data-id");
      openLightbox(dataId);
    });
  });

  document.body.addEventListener("click", (e) => {
    if (e.target == document.querySelector(".pictures_carousel .lightbox")) {
      let dataId = document
        .querySelector(".pictures_carousel .lightbox")
        .getAttribute("data-id");
      closeLightbox(dataId);
    }
  });
}

function setElementWrapped() {
  wrappedImages.forEach((element) => {
    let elementToUnwrap;
    let elementToRemove;

    if (
      (element.parentNode.tagName === "A" ||
        element.parentNode.tagName === "SPAN") &&
      element.parentNode.childElementCount === 1
    ) {
      elementToUnwrap = element.parentNode.outerHTML;
      elementToRemove = element.parentNode;
    } else if (element.parentNode.tagName === "P") {
      if (
        element.parentNode.childElementCount === 1 &&
        element.parentNode.textContent === ""
      ) {
        elementToUnwrap = element.outerHTML;
        elementToRemove = element.parentNode;
      } else {
        elementToUnwrap = element.outerHTML;
        elementToRemove = element;
      }
    }

    unwrapElement(elementToUnwrap, elementToRemove);
  });
}

function unwrapElement(elementToUnwrap, elementToRemove) {
  if (elementToRemove.tagName === "P") {
    elementToRemove.insertAdjacentHTML("beforeBegin", elementToUnwrap);
    elementToRemove.remove();
  } else {
    let ancestors = [];

    while (elementToRemove) {
      ancestors.unshift(elementToRemove);
      elementToRemove = elementToRemove.parentNode;
      if (elementToRemove != null) {
        if (elementToRemove.tagName === "P") {
          elementToRemove.insertAdjacentHTML("beforeBegin", elementToUnwrap);
          elementToRemove.remove();
        }
      }
    }
  }
}

//Header Events
function headerEvents() {
  if (window.scrollY === 0) {
    headerHero.classList.add("ontop");
  } else {
    headerHero.classList.remove("ontop");
  }
}

//Main Menu
function toggleMenu(e) {
  e.preventDefault();
  mainMenu.classList.toggle("active");
  menuButton.classList.toggle("active");
}

//SubMenu
function toggleSubMenu(e) {
  let target = e.target;
  if (target.tagName !== "A") {
    target.classList.toggle("active");
  }
}

//HP Picture Carousel lightbox
function openLightbox(dataId) {
  lightbox.forEach((element) => {
    if (dataId == element.getAttribute("data-id")) {
      let lightboxContent = element.content.cloneNode(true);
      document.querySelector(".pictures_carousel").appendChild(lightboxContent);

      lightboxChild = document.querySelector(".pictures_carousel .lightbox");
      lightboxChild.setAttribute("data-id", dataId);

      lightboxChild.style.display = "flex";
      setTimeout(() => {
        lightboxChild.classList.add("open");
      }, 300);
      lightboxChild
        .querySelector(".close")
        .addEventListener("click", () => closeLightbox(dataId));
    }
  });
}

function closeLightbox(dataId) {
  let element = document.querySelector(
    `.pictures_carousel .lightbox[data-id="${dataId}"]`
  );
  element.classList.remove("open");
  setTimeout(() => {
    element.style.display = "none";
    element.remove();
  }, 300);
}

//Swiper Lightbox Carousel
var swipperPicCarousel = new Swiper(".pic_carousel", {
  slidesPerView: 1,
  spaceBetween: 30,
  autoHeight: true,
  loop: true,
  createElements: true,
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    1440: {
      slidesPerView: 4,
      rewind: true,
      keyboard: true,
      allowSlideNext: true,
      allowSlidePrev: true,
      simulateTouch: false,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    },
  },
});

//Swiper Maestros
var swiperMaestros = new Swiper(".maestros_carousel.swiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  autoHeight: true,
  loop: true,
  createElements: true,
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    1440: {
      slidesPerView: 4,
      rewind: true,
      keyboard: true,
      allowSlideNext: true,
      allowSlidePrev: true,
      simulateTouch: false,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    },
  },
});

//Articles Banner
var swiperArticles = new Swiper(".articles__wrapper.swiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  autoHeight: true,
  loop: true,
  createElements: true,
  autoplay: {
    delay: 5000,
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    1440: {
      enabled: false,
      slidesPerView: 4,
    },
  },
});

//Swiper
//Events Banner
var swiperEvents = new Swiper(".events__wrapper.swiper", {
  slidesPerView: 1,
  autoHeight: true,
  spaceBetween: 30,
  loop: true,
  createElements: true,
  autoplay: {
    delay: 5000,
  },
  pagination: {
    el: ".swiper-pagination",
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    1440: {
      slidesPerView: 4,
      rewind: true,
      keyboard: true,
      allowSlideNext: true,
      allowSlidePrev: true,
      simulateTouch: false,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    },
  },
});
