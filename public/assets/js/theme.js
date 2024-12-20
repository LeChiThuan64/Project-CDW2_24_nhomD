/* eslint-disable no-unused-vars */
// eslint-disable-next-line no-undef
var $ = jQuery.noConflict();

let UomoSections = {};
let UomoElements = {};

let UomoSelectors = {
  pageBackDropActiveClass: 'page-overlay_visible',
  quantityControl: '.qty-control',
  scrollToTopId: 'scrollTop',
  $pageBackDrop: document.querySelector('.page-overlay'),
  scrollWidth: window.innerWidth - document.body.clientWidth + 'px',
  jsContentVisible: '.js-content_visible',
  starRatingControl: '.star-rating .star-rating__star-icon',
}

// Utility functions
let UomoHelpers = {
  isMobile: false,
  sideStkEl: {},

  debounce: (callback, wait, immediate = false) => {
    let timeout = null;

    return function () {
      const callNow = immediate && !timeout;
      const next = () => callback.apply(this, arguments);

      clearTimeout(timeout);
      timeout = setTimeout(next, wait);

      if (callNow) {
        next();
      }
    }
  },

  showPageBackdrop: () => {
    UomoSelectors.$pageBackDrop && UomoSelectors.$pageBackDrop.classList.add(UomoSelectors.pageBackDropActiveClass);
    document.body.classList.add('overflow-hidden');
    document.body.style.paddingRight = UomoSelectors.scrollWidth;
    document.querySelectorAll('.header_sticky, .footer-mobile').forEach(element => {
      element.style.borderRight = UomoSelectors.scrollWidth + ' solid transparent';
    });
  },

  hidePageBackdrop: () => {
    UomoSelectors.$pageBackDrop && UomoSelectors.$pageBackDrop.classList.remove(UomoSelectors.pageBackDropActiveClass);
    document.body.classList.remove('overflow-hidden');
    document.body.style.paddingRight = '';
    document.querySelectorAll('.header_sticky, .footer-mobile').forEach(element => {
      element.style.borderRight = '';
    });
  },

  hideHoverComponents: () => {
    document.querySelectorAll(UomoSelectors.jsContentVisible).forEach(el => {
      el.classList.remove(UomoSelectors.jsContentVisible.substring(1));
    });
  },

  updateDeviceSize: () => {
    return window.innerWidth < 992
  }
};

function purecookieDismiss() {
  setCookie("purecookieDismiss", "1", 7), pureFadeOut("cookieConsentContainer")
}

function setCookie(e, o, i) {
  var t = "";
  if (i) {
    var n = new Date;
    n.setTime(n.getTime() + 24 * i * 60 * 60 * 1e3), t = "; expires=" + n.toUTCString()
  }
  document.cookie = e + "=" + (o || "") + t + "; path=/"
}

function pureFadeOut(e) {
  var o = document.getElementById(e);
  o.style.opacity = 1,
    function e() {
      (o.style.opacity -= .02) < 0 ? o.style.display = "none" : requestAnimationFrame(e)
    }()
}

(function () {
  'use strict';

  // Scroll bar width
  const scrollBarWidth = window.innerWidth - document.body.clientWidth

  // Components appear after click
  UomoElements.JsHoverContent = (function () {
    function JsHoverContent() {
      const visibleClass = UomoSelectors.jsContentVisible.substring(1);

      document.querySelectorAll('.js-hover__open').forEach(el => {
        el.addEventListener('click', (e) => {
          e.preventDefault();

          const $container = e.currentTarget.closest('.hover-container');
          if ($container.classList.contains(visibleClass)) {
            $container.classList.remove(visibleClass);
            // e.stopPropagation();
          } else {
            UomoHelpers.hideHoverComponents();
            $container.classList.add(visibleClass);
          }
        });
      });

      document.addEventListener('click', (e) => {
        if (!e.target.closest(UomoSelectors.jsContentVisible)) {
          UomoHelpers.hideHoverComponents();
        }
      });
    }


    return JsHoverContent;
  })();

  UomoElements.QtyControl = (function () {
    function QtyControl() {
      document.querySelectorAll(UomoSelectors.quantityControl).forEach(function ($qty) {
        if ($qty.classList.contains('qty-initialized')) {
          return;
        }

        $qty.classList.add('qty-initialized');
        const $reduce = $qty.querySelector('.qty-control__reduce');
        const $increase = $qty.querySelector('.qty-control__increase');
        const $number = $qty.querySelector('.qty-control__number');

        $reduce.addEventListener('click', function () {
          $number.value = parseInt($number.value) > 1 ? parseInt($number.value) - 1 : parseInt($number.value);
        });

        $increase.addEventListener('click', function () {
          $number.value = parseInt($number.value) + 1;
        });
      });
    }

    return QtyControl;
  })();

  UomoElements.ScrollToTop = (function () {
    function ScrollToTop() {
      const $scrollTop = document.getElementById(UomoSelectors.scrollToTopId);

      if (!$scrollTop) {
        return;
      }

      $scrollTop.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        window.scrollTo(window.scrollX, 0);
      });

      let scrolled = false;
      window.addEventListener('scroll', function () {
        if (250 < window.scrollY && !scrolled) {
          $scrollTop.classList.remove('visually-hidden');
          scrolled = true;
        }

        if (250 > window.scrollY && scrolled) {
          $scrollTop.classList.add('visually-hidden');
          scrolled = false;
        }
      });
    }

    return ScrollToTop;
  })();

  UomoElements.Search = (function () {
    function Search() {
      // Declare variables
      this.selectors = {
        container: '.search-field',
        inputBox: '.search-field__input',
        searchSuggestItem: '.search-suggestion a.menu-link',
        searchFieldActor: '.search-field__actor',
        resetButton: '.search-popup__reset',
        searchCategorySelector: '.js-search-select',
        resultContainer: '.search-result',
        ajaxURL: './search.html'
      }

      this.searchInputFocusedClass = 'search-field__focused';

      this.$containers = document.querySelectorAll(this.selectors.container);

      this._initSearchSelect();
      this._initSearchReset();
      this._initSearchInputFocus();
      this._initAjaxSearch();

      this._handleAjaxSearch = this._handleAjaxSearch.bind(this);
      this._updateSearchResult = this._updateSearchResult.bind(this);
    }

    Search.prototype = Object.assign({}, Search.prototype, {
      _initSearchSelect: function () {
        const _this = this;
        this.$containers.forEach(el => {
          /**
           * Filter suggestion list on input
           */

          const $inputBox = el.querySelector(_this.selectors.inputBox);
          $inputBox && $inputBox.addEventListener('keyup', (e) => {
            const filterValue = e.currentTarget.value.toUpperCase();
            el.querySelectorAll(_this.selectors.searchSuggestItem).forEach(el => {
              const txtValue = el.innerText;

              if (txtValue.toUpperCase().indexOf(filterValue) > -1) {
                el.style.display = "";
              } else {
                el.style.display = "none";
              }
            });
          });

          /**
           * Search category selector
           */
          el.querySelectorAll(_this.selectors.searchCategorySelector).forEach(scs => {
            scs.addEventListener('click', function (e) {
              e.preventDefault();
              const $s_f_a = el.querySelector(_this.selectors.searchFieldActor);
              if ($s_f_a) {
                $s_f_a.value = e.target.innerText;
              }
            });
          });
        })
      },

      _removeFormActiveClass($eventEl) {
        const $parentDiv = $eventEl.closest(this.selectors.container);
        $parentDiv.classList.remove(this.searchInputFocusedClass);
      },

      _initSearchReset: function () {
        const _this = this;
        document.querySelectorAll(this.selectors.resetButton).forEach(el => {
          el.addEventListener('click', function (e) {
            const $parentDiv = e.target.closest(_this.selectors.container);
            const $inputBox = $parentDiv.querySelector(_this.selectors.inputBox);
            const $rc = $parentDiv.querySelector(_this.selectors.resultContainer);

            $inputBox.value = '';
            $rc.innerHtml = '';
            _this._removeFormActiveClass(e.target);
          });
        })
      },

      _initSearchInputFocus: function () {
        const _this = this;

        document.querySelectorAll(this.selectors.inputBox).forEach(el => {
          el.addEventListener('blur', function (e) {
            if (e.target.value.length == 0) {
              _this._removeFormActiveClass(e.target);
            }
          })
        });
      },

      _initAjaxSearch: function () {
        const _this = this;
        document.querySelectorAll(this.selectors.inputBox).forEach(el => {
          el.addEventListener('keyup', (event) => {
            if (event.target.value.length == 0) {
              _this._removeFormActiveClass(event.target);
            } else {
              _this._handleAjaxSearch(event, _this);
            }
          });
        })
      },

      _handleAjaxSearch: UomoHelpers.debounce((event, _this) => {
        const $form = event.target.closest(_this.selectors.container);
        const method = $form ? $form.method : 'GET';
        const url = _this.selectors.ajaxURL;

        url && fetch(url, { method: method }).then(function (response) {
          if (response.ok) {
            return response.text();
          } else {
            return Promise.reject(response);
          }
        }).then(function (data) {
          _this._updateSearchResult(data, $form);
        }).catch(function (err) {
          _this._handleAjaxSearchError(err.message, $form);
        });
      }, 180),

      _updateSearchResult: function (data, $form) {
        const $ajaxDom = new DOMParser().parseFromString(data, 'text/html');
        // Get filtered result dom
        const $f_r = $ajaxDom.querySelector('.search-result');
        $form.querySelector(this.selectors.resultContainer).innerHTML = $f_r.innerHTML;
        $form.classList.add(this.searchInputFocusedClass);
      },

      _handleAjaxSearchError: function (error, $form) {
        $form.classList.remove(this.searchInputFocusedClass);
        console.log(error);
      }
    });

    return Search
  })();

  // Aside Popup
  UomoElements.Aside = (function () {
    function Aside() {
      this.selectors = {
        activator: '.js-open-aside',
        closeBtn: '.js-close-aside',
        activeClass: 'aside_visible'
      }

      this.$asideActivators = document.querySelectorAll(this.selectors.activator);
      this.$closeBtns = document.querySelectorAll(this.selectors.closeBtn);

      this._init();
      this._initCloseActions();
      this._initBackDropClick();
    }

    Aside.prototype = Object.assign({}, Aside.prototype, {
      _init: function () {
        const _this = this;
        $(document).on("click", this.selectors.activator, function (e) {
          e.preventDefault();

          const targetElId = $(this).data("aside");
          const $targetAside = document.getElementById(targetElId);

          UomoHelpers.showPageBackdrop();
          $targetAside && $targetAside.classList.add(_this.selectors.activeClass);
        });
      },

      _initCloseActions: function () {
        const _this = this;
        this.$closeBtns.forEach(el => {
          el.addEventListener('click', (event) => {
            event.preventDefault();
            _this._closeAside();
          });
        });
      },

      _initBackDropClick() {
        if (UomoSelectors.$pageBackDrop) {
          UomoSelectors.$pageBackDrop.addEventListener('click', () => {
            this._closeAside();
          });
        }
      },

      _closeAside: function () {
        UomoHelpers.hidePageBackdrop();
        document.querySelectorAll('.' + this.selectors.activeClass).forEach(el => {
          el.classList.remove(this.selectors.activeClass);
        });
      }
    });

    return Aside;
  })();

  UomoElements.Countdown = (function () {
    function Countdown(container) {
      this.selectors = {
        element: '.js-countdown'
      }

      this.$container = container || document.body;

      this._init()
    }

    Countdown.prototype = Object.assign({}, Countdown.prototype, {
      _init: function () {
        const _this = this;
        const $countdowns = this.$container.querySelectorAll(this.selectors.element);
        $countdowns.forEach(function ($el) {
          _this._initElement($el);
        });
      },

      _initElement($el) {
        // eslint-disable-next-line no-undef
        const timer = new countdown({
          target: $el
        });
      }
    });


    return Countdown;
  })();

  UomoElements.ShopViewChange = (function () {
    function ShopViewChange() {
      this.selectors = {
        element: '.js-cols-size',
        activeClass: 'btn-link_active'
      }

      this.$buttons = document.querySelectorAll(this.selectors.element);

      this._init();
    }

    ShopViewChange.prototype = Object.assign({}, ShopViewChange.prototype, {
      _init: function () {
        const _this = this;
        this.$buttons.forEach(function ($btn) {
          $btn.addEventListener('click', function (event) {
            event.preventDefault();
            const targetDomId = $btn.dataset.target;
            _this._resetActiveLinks();
            this.classList.add(_this.selectors.activeClass);
            const newCol = $btn.dataset.cols;
            _this._changeViewCols(targetDomId, newCol);
          });
        });
      },

      _changeViewCols(parentId, newCol) {
        const $targetDom = document.getElementById(parentId);
        if ($targetDom) {
          $targetDom.classList.remove(
            'row-cols-xl-2', 'row-cols-xl-3', 'row-cols-xl-4', 'row-cols-xl-5', 'row-cols-xl-6',
            'row-cols-lg-2', 'row-cols-lg-3', 'row-cols-lg-4', 'row-cols-lg-5', 'row-cols-lg-6');
          $targetDom.classList.add('row-cols-xl-' + newCol, 'row-cols-lg-' + newCol);
        }
      },

      _resetActiveLinks() {
        const _this = this;
        document.querySelectorAll(`${this.selectors.element}.${this.selectors.activeClass}`).forEach($el => {
          $el.classList.remove(_this.selectors.activeClass);
        });
      }
    });

    return ShopViewChange;
  })();

  UomoElements.Filters = (function () {
    function Filters() {
      this.selectors = {
        element: '.js-filter',
        activeClass: 'swatch_active',
      }

      this.$buttons = document.querySelectorAll(this.selectors.element);

      this._init();
    }

    Filters.prototype = Object.assign({}, Filters.prototype, {
      _init: function () {
        const _this = this;
        this.$buttons.forEach(function ($btn) {
          $btn.addEventListener('click', function (event) {
            event.preventDefault();
            _this._toggleActive($btn);
          });
        });
      },

      _toggleActive($btn) {
        if ($btn.classList.contains(this.selectors.activeClass)) {
          $btn.classList.remove(this.selectors.activeClass);
        } else {
          $btn.classList.add(this.selectors.activeClass);
        }
      }
    });


    return Filters;
  })();

  UomoElements.StickyElement = (function () {
    function StickyElement() {
      this.selectors = {
        element: '.side-sticky'
      }

      this.$stickies = document.querySelectorAll(this.selectors.element);
      this._updateStatus = this._updateStatus.bind(this);
      this._init();
    }

    StickyElement.prototype = Object.assign({}, StickyElement.prototype, {
      _init: function () {
        if (UomoHelpers.isMobile) {
          return;
        }

        this.$stickies.forEach(function ($sticky) {
          const $grid = $sticky.previousElementSibling || $sticky.nextElementSibling;
          const $target = $grid.offsetHeight > $sticky.offsetHeight ? $sticky : $grid;

          $target.lastKnownY = window.scrollY;
          if (!UomoHelpers.sideStkEl.currentTop) {
            UomoHelpers.sideStkEl.currentTop = 0;
          } else {
            return;
          }


          UomoHelpers.sideStkEl.initialTopOffset = parseInt(window.getComputedStyle($target).top);
        });

        window.addEventListener('scroll', this._updateStatus);
      },

      _updateStatus() {
        const _this = this;

        _this.$stickies.forEach(function ($sticky) {
          const $grid = $sticky.previousElementSibling || $sticky.nextElementSibling;
          const $target = $grid.offsetHeight > $sticky.offsetHeight ? $sticky : $grid;

          var bounds = $target.getBoundingClientRect(),
            maxTop = bounds.top + window.scrollY - $target.offsetTop + UomoHelpers.sideStkEl.initialTopOffset,
            minTop = $target.clientHeight - window.innerHeight + 30;

          if (window.scrollY < $target.lastKnownY) {
            UomoHelpers.sideStkEl.currentTop -= window.scrollY - $target.lastKnownY;
          } else {
            UomoHelpers.sideStkEl.currentTop += $target.lastKnownY - window.scrollY;
          }


          UomoHelpers.sideStkEl.currentTop = Math.min(Math.max(UomoHelpers.sideStkEl.currentTop, -minTop), maxTop, UomoHelpers.sideStkEl.initialTopOffset);
          $target.lastKnownY = window.scrollY;

          $target.style.top = UomoHelpers.sideStkEl.currentTop + 'px';
        });
      }
    });


    return StickyElement;
  })();

  // Header Section
  UomoSections.Header = (function () {
    function Header() {
      this.selectors = {
        header: '.header',
        mobileHeader: '.header-mobile',
        mobileMenuActivator: '.mobile-nav-activator',
        mobileMenu: '.navigation',
        mobileMenuActiveClass: 'mobile-menu-opened',
        mobileSubNavOpen: '.js-nav-right',
        mobileSubNavClose: '.js-nav-left',
        mobileSubNavHiddenClass: 'd-none',
        stickyHeader: '.header_sticky',
        stickyActiveClass: 'header_sticky-active',
      }

      // Set sticky active class from
      this.stickyMinPos = 25;
      this.stkHd = false;

      this._init = this._init.bind(this);
      this._stickyScrollHander = this._stickyScrollHander.bind(this);
      this._init();
      window.addEventListener('resize', this._init);
    }

    Header.prototype = Object.assign({}, Header.prototype, {
      _init: function () {
        const headerClass = UomoHelpers.isMobile ? this.selectors.mobileHeader : this.selectors.header;

        this.lastScrollTop = 0;
        this.$header = document.querySelector(headerClass);

        if (!this.$header) {
          return;
        }

        if (!UomoHelpers.isMobile) {
          this._initMenuPosition();
        } else {
          this._initMobileMenu();
        }

        this._initStickyHeader();
      },

      _initMobileMenu: function () {
        const _this = this;
        const mobileMenuActivator = this.$header.querySelector(this.selectors.mobileMenuActivator);
        const $mobileDropdown = this.$header.querySelector(this.selectors.mobileMenu);
        let transformLeft = 0;
        if ($mobileDropdown) {
          mobileMenuActivator && $(mobileMenuActivator).off('click').on('click', function (event) {
            event.preventDefault();
            if (document.body.classList.contains(_this.selectors.mobileMenuActiveClass)) {
              document.body.classList.remove(_this.selectors.mobileMenuActiveClass);
              _this.$header.style.paddingRight = '';
              $mobileDropdown.style.paddingRight = '';
            } else {
              document.body.classList.add(_this.selectors.mobileMenuActiveClass);
              _this.$header.style.paddingRight = UomoSelectors.scrollWidth;
              $mobileDropdown.style.paddingRight = UomoSelectors.scrollWidth;
            }
          });

          const $mobileMenu = $mobileDropdown.querySelector('.navigation__list');
          let menuMaxHeight = $mobileMenu.offsetHeight;
          $mobileMenu && $mobileMenu.querySelectorAll(_this.selectors.mobileSubNavOpen).forEach($btn => {
            $btn.addEventListener('click', function (event) {
              event.preventDefault;
              $btn.nextElementSibling.classList.remove(_this.selectors.mobileSubNavHiddenClass);

              transformLeft -= 100;
              if (menuMaxHeight < $btn.nextElementSibling.offsetHeight) {
                $mobileMenu.style.transform = 'translateX(' + transformLeft.toString() + '%)';
                $mobileMenu.style.minHeight = $btn.nextElementSibling.offsetHeight + 'px';
              } else {
                $mobileMenu.style.transform = 'translateX(' + transformLeft.toString() + '%)';
                $mobileMenu.style.minHeight = menuMaxHeight + 'px';
              }
            });
          });


          $mobileMenu && $mobileMenu.querySelectorAll(_this.selectors.mobileSubNavClose).forEach($btn => {
            $btn.addEventListener('click', function (event) {
              event.preventDefault;
              transformLeft += 100;
              $mobileMenu.style.transform = 'translateX(' + transformLeft.toString() + '%)';
              $btn.parentElement.classList.add(_this.selectors.mobileSubNavHiddenClass);
              const $wrapper = $btn.closest('.sub-menu');
              if ($wrapper) {
                const minHeight = menuMaxHeight < $wrapper.offsetHeight ? $wrapper.offsetHeight : menuMaxHeight;
                $mobileMenu.style.minHeight = minHeight + 'px';
              }
            });
          });
        }
      },

      _initStickyHeader: function () {
        if (this.$header.classList.contains(this.selectors.stickyHeader)) {
          return;
        }

        const _this = this;
        let headerHeight = this.$header.offsetHeight;
        if (this.$header.classList.contains("header-transparent-bg")) {
          headerHeight = 0;

          if (document.querySelectorAll(".header-transparent-bg .header-top").length > 0) {
            headerHeight = document.querySelector(".header-transparent-bg .header-top").offsetHeight;
          }
        }

        document.querySelector("main").style.paddingTop = headerHeight + 'px';
        _this.$header.classList.add('position-absolute');

        document.removeEventListener('scroll', this._stickyScrollHander);
        document.addEventListener('scroll', this._stickyScrollHander);
      },

      _initMenuPosition() {
        const _this = this;
        _this.$header.querySelectorAll('.box-menu').forEach(el => {
          _this._setBoxMenuPosition(el)
        });

        _this.$header.querySelectorAll('.default-menu').forEach(el => {
          _this._setDefaultMenuPosition(el)
        });
      },

      _setBoxMenuPosition(menu) {
        const limitR = window.innerWidth - menu.offsetWidth - scrollBarWidth;
        const limitL = 0;
        const menuPaddingLeft = parseInt(window.getComputedStyle(menu, null).getPropertyValue('padding-left'));
        const parentPaddingLeft = parseInt(window.getComputedStyle(menu.previousElementSibling, null).getPropertyValue('padding-left'));
        const centerPos = menu.previousElementSibling.offsetLeft - menuPaddingLeft + parentPaddingLeft;

        let menuPos = centerPos;
        if (centerPos < limitL) {
          menuPos = limitL;
        } else if (centerPos > limitR) {
          menuPos = limitR;
        }

        menu.style.left = `${menuPos}px`;
      },

      _setDefaultMenuPosition(menu) {
        const limitR = window.innerWidth - menu.offsetWidth - scrollBarWidth;
        const limitL = 0;
        const menuPaddingLeft = parseInt(window.getComputedStyle(menu, null).getPropertyValue('padding-left'));
        const parentPaddingLeft = parseInt(window.getComputedStyle(menu.previousElementSibling, null).getPropertyValue('padding-left'));
        const centerPos = menu.previousElementSibling.offsetLeft - menuPaddingLeft + parentPaddingLeft;

        let menuPos = centerPos;
        if (centerPos < limitL) {
          menuPos = limitL;
        } else if (centerPos > limitR) {
          menuPos = limitR;
        }

        menu.style.left = `${menuPos}px`;
      },

      _stickyScrollHander() {
        if (this.$header.classList.contains("sticky_disabled")) {
          return;
        }
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScrollTop > this.lastScrollTop || currentScrollTop < this.stickyMinPos) {
          this.$header.classList.remove(this.selectors.stickyActiveClass);
          this.$header.classList.add('position-absolute');
        } else if (currentScrollTop > this.stickyMinPos) {
          this.$header.classList.add(this.selectors.stickyActiveClass);
          this.$header.classList.remove('position-absolute');
        }

        this.lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
      }
    });


    return Header;
  })();

  // Footer Section
  UomoSections.Footer = (function () {
    function Footer() {
      this.selectors = {
        footer: '.footer-mobile'
      }
      this.$footer = document.querySelector(this.selectors.footer);

      this._init = this._init.bind(this);
      this._init();
      window.addEventListener('resize', this._init);
    }

    Footer.prototype = Object.assign({}, Footer.prototype, {
      _init: function () {
        if (!this.$footer || !UomoHelpers.isMobile) {
          return;
        }

        setTimeout(() => {
          this._initStickyFooter();
        }, 750);
      },

      _initStickyFooter: function () {
        const height = this.$footer.offsetHeight;

        document.body.style.paddingBottom = height + 'px';
        this.$footer.classList.add('position-fixed');
        setTimeout(() => {
          this.$footer.classList.add('footer-mobile_initialized');
        }, 750);
      },
    });


    return Footer;
  })();

  // Customer login form
  UomoSections.CustomerSideForm = (function () {
    function CustomerSideForm() {
      this.selectors = {
        aside: '.aside.customer-forms',
        formsWrapper: '.customer-forms__wrapper',
        registerActivator: '.js-show-register',
        loginActivator: '.js-show-login'
      }

      this.$aside = document.querySelector(this.selectors.aside);
      if (!this.$aside) {
        return false;
      }

      this.$formsWrapper = this.$aside.querySelector(this.selectors.formsWrapper);
      this.$registerActivator = this.$aside.querySelector(this.selectors.registerActivator);
      this.$loginActivator = this.$aside.querySelector(this.selectors.loginActivator);

      this.$formsWrapper && this._showLoginForm()
      this.$formsWrapper && this._showRegisterForm()
    }

    CustomerSideForm.prototype = Object.assign({}, CustomerSideForm.prototype, {
      _showLoginForm: function () {
        this.$loginActivator.addEventListener('click', () => {
          this.$formsWrapper.style.left = 0;
        });
      },

      _showRegisterForm: function () {
        this.$registerActivator.addEventListener('click', () => {
          this.$formsWrapper.style.left = '-100%';
        });
      }
    });

    return CustomerSideForm;
  })();

  UomoSections.CartDrawer = (function () {
    function CartDrawer() {
      this.selectors = {
        aside: '.aside.cart-drawer',
        asideHeader: '.aside-header',
        cartItemRemover: '.js-cart-item-remove',
        cartActions: '.cart-drawer-actions',
        cartItemsList: '.cart-drawer-items-list'
      }

      this.asideContentMargin = 30;

      this.$aside = document.querySelector(this.selectors.aside);
      if (!this.$aside) {
        return false;
      }

      this.$header = this.$aside.querySelector(this.selectors.asideHeader);
      this.$actions = this.$aside.querySelector(this.selectors.cartActions);
      this.$list = this.$aside.querySelector(this.selectors.cartItemsList);

      setTimeout(() => {
        this._initCartItemsList();
        this._initCartItemRemoval();
      }, 1000);
    }

    CartDrawer.prototype = Object.assign({}, CartDrawer.prototype, {
      _initCartItemsList: function () {
        if (!UomoHelpers.isMobile) {
          return;
        }

        const drawerHeight = this.$aside.offsetHeight;
        const headerHeight = this.$header ? this.$header.offsetHeight : 0;
        const actionsHeader = this.$actions ? this.$actions.offsetHeight : 0;

        if (this.$list) {
          this.$list.style.maxHeight = drawerHeight - headerHeight - actionsHeader - this.asideContentMargin * 2 + 'px';
        }
      },

      _initCartItemRemoval: function () {
        this.$aside.querySelectorAll(this.selectors.cartItemRemover).forEach(el => {
          el.addEventListener('click', (event) => {
            event.preventDefault();
            const $parentEl = event.target.parentElement;
            const $divider = $parentEl.nextElementSibling;
            $parentEl.classList.add('_removed');
            $divider && $divider.classList.contains('cart-drawer-divider') && $divider.classList.add('_removed');
            setTimeout(() => {
              $parentEl.remove();
              $divider && $divider.classList.contains('cart-drawer-divider') && $divider.remove();
            }, 350);
          });
        });
      }
    });

    return CartDrawer;
  })();

  UomoSections.SwiperSlideshow = (function () {
    function SwiperSlideshow() {
      this.selectors = {
        container: '.js-swiper-slider'
      }

      this.$containers = document.querySelectorAll(this.selectors.container);
      this._initSliders();
    }

    SwiperSlideshow.prototype = Object.assign({}, SwiperSlideshow.prototype, {
      _initSliders() {
        this.$containers.forEach(function ($sliderContainer) {
          if ($sliderContainer.classList.contains('swiper-container-initialized')) {
            return;
          }

          let settings = {
            autoplay: 0,
            slidesPerView: 1,
            loop: true,
            navigation: {
              nextEl: ".pc__img-next",
              prevEl: ".pc__img-prev"
            }
          };

          if ($sliderContainer.classList.contains('swiper-number-pagination')) {
            settings = Object.assign(settings, {
              pagination: {
                "el": ".slideshow-pagination",
                "type": "bullets",
                "clickable": true,
                renderBullet: function (index, className) {
                  return '<span class="' + className + '">' + (index + 1).toString().padStart(2, '0') + '</span>';
                }
              }
            });
          }

          if ($sliderContainer.dataset.settings) {
            settings = Object.assign(settings, JSON.parse($sliderContainer.dataset.settings));
          }

          if ($sliderContainer.querySelectorAll('.swiper-slide').length > 1) {
            // eslint-disable-next-line no-undef
            new Swiper($sliderContainer, settings);
          } else {
            $sliderContainer.classList.add('swiper-container-initialized');
            const $active_slide = $sliderContainer.querySelector('.swiper-slide');
            $active_slide && $active_slide.classList.add('swiper-slide-active');
          }
        });
      }
    });

    return SwiperSlideshow;
  })();

  UomoSections.ProductSingleMedia = (function () {
    function ProductSingleMedia() {
      this.selectors = {
        container: '.product-single__media'
      }

      this.$containers = $(this.selectors.container);
      this._initProductMedia();
    }

    function setSlideHeight(that) {
      $('.product-single__thumbnail .swiper-slide').css({ height: 'auto' });
      var currentSlide = that.activeIndex;
      var newHeight = $(that.slides[currentSlide]).height();

      $('.product-single__thumbnail .swiper-wrapper, .product-single__thumbnail .swiper-slide').css({ height: newHeight })
      that.update();
    }

    ProductSingleMedia.prototype = Object.assign({}, ProductSingleMedia.prototype, {
      _initProductMedia() {
        this.$containers.each(function () {
          if ($(this).hasClass('product-media-initialized')) {
            return;
          }

          let media_type = $(this).data('media-type');

          $(this).addClass(media_type);

          if (media_type == 'vertical-thumbnail') {
            var galleryThumbs = new Swiper(".product-single__thumbnail .swiper-container", {
              direction: 'vertical',
              slidesPerView: 6,
              spaceBetween: 0,
              freeMode: true,
              breakpoints: {
                0: {
                  direction: 'horizontal',
                  slidesPerView: 4,
                },
                992: {
                  direction: 'vertical',
                }
              },
              on: {
                init: function () {
                  setSlideHeight(this);
                },
                slideChangeTransitionEnd: function () {
                  setSlideHeight(this);
                }
              }
            });
            var galleryMain = new Swiper(".product-single__image .swiper-container", {
              direction: 'horizontal',
              slidesPerView: 1,
              spaceBetween: 32,
              mousewheel: false,
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
              },
              grabCursor: true,
              thumbs: {
                swiper: galleryThumbs
              },
              on: {
                slideChangeTransitionStart: function () {
                  galleryThumbs.slideTo(galleryMain.activeIndex);
                }
              }
            });
          } else if (media_type == 'vertical-dot') {
            var galleryMain = new Swiper(".product-single__image .swiper-container", {
              direction: 'horizontal',
              slidesPerView: 1,
              spaceBetween: 32,
              mousewheel: false,
              grabCursor: true,
              pagination: {
                el: ".product-single__image .swiper-pagination",
                type: "bullets",
                clickable: true
              },
            });
          } else if (media_type == 'scroll-snap') {
            // $("html").addClass("snap");

            // window.addEventListener('scroll', function() {
            //   if ( $(".product-single__media").height() - $(window).height() < window.scrollY ) {
            //     $("html").removeClass("snap");
            //   } else {
            //     $("html").addClass("snap");
            //   }
            // });
          } else if (media_type == 'horizontal-thumbnail') {
            var galleryThumbs = new Swiper(".product-single__thumbnail .swiper-container", {
              direction: 'horizontal',
              slidesPerView: 6,
              spaceBetween: 0,
              freeMode: true,
              breakpoints: {
                0: {
                  slidesPerView: 4,
                },
                992: {
                  slidesPerView: 7,
                }
              }
            });
            var galleryMain = new Swiper(".product-single__image .swiper-container", {
              direction: 'horizontal',
              slidesPerView: 1,
              spaceBetween: 32,
              mousewheel: false,
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
              },
              grabCursor: true,
              thumbs: {
                swiper: galleryThumbs
              },
              on: {
                slideChangeTransitionStart: function () {
                  galleryThumbs.slideTo(galleryMain.activeIndex);
                }
              }
            });
          }

          $(this).addClass('product-media-initialized');
        });
      }
    });

    return ProductSingleMedia;
  })();

  UomoElements.StarRating = (function () {
    function StarRating() {
      let stars = Array.from(document.querySelectorAll(UomoSelectors.starRatingControl));
      let user_selected_star = document.querySelector('#form-input-rating');

      stars.forEach(star => {
        // Mouseover event
        star.addEventListener('mouseover', (e) => {
          stars.forEach((item, current_index) => {
            if (current_index <= stars.indexOf(e.target)) {
              item.classList.add('is-overed');
            } else {
              item.classList.remove('is-overed');
            }
          })
        })

        // Mouseover event
        star.addEventListener('mouseleave', (e) => {
          stars.forEach((item) => {
            item.classList.remove('is-overed');
          })
        })

        // Click event
        star.addEventListener('click', (e) => {
          const selected_index = stars.indexOf(e.target);
          user_selected_star.value = selected_index + 1;
          stars.forEach((item, current_index) => {
            if (current_index <= stars.indexOf(e.target)) {
              item.classList.add('is-selected');
            } else {
              item.classList.remove('is-selected');
            }
          })
        })
      })
    }

    return StarRating;
  })();

  class Uomo {
    constructor() {
      this.initCookieConsient();
      this.initAccessories();
      this.initMultiSelect();
      this.initBsTooltips();
      this.initRangeSlider();

      new UomoElements.JsHoverContent();
      new UomoElements.Search();
      new UomoElements.Aside();
      new UomoElements.QtyControl();
      new UomoElements.ScrollToTop();
      new UomoElements.Countdown();
      new UomoElements.ShopViewChange();
      new UomoElements.Filters();
      new UomoElements.StickyElement();
      new UomoElements.StarRating();

      new UomoSections.Header();
      new UomoSections.Footer();
      new UomoSections.CustomerSideForm();
      new UomoSections.CartDrawer();
      new UomoSections.SwiperSlideshow();
      new UomoSections.ProductSingleMedia();
    }

    initCookieConsient() {
      const purecookieDesc = "In order to provide you a personalized shopping experience, our site uses cookies. By continuing to use this site, you are agreeing to our cookie policy.",
        purecookieButton = "Accept";

      function pureFadeIn(e, o) {
        var i = document.getElementById(e);
        i.style.opacity = 0, i.style.display = o || "block",
          function e() {
            var o = parseFloat(i.style.opacity);
            (o += .02) > 1 || (i.style.opacity = o, requestAnimationFrame(e))
          }()
      }

      function getCookie(e) {
        for (var o = e + "=", i = document.cookie.split(";"), t = 0; t < i.length; t++) {
          for (var n = i[t]; " " == n.charAt(0);) {
            n = n.substring(1, n.length);
          }
          if (0 == n.indexOf(o))
            return n.substring(o.length, n.length)
        }
        return null
      }

      function appendHtml(el, str) {
        var div = document.createElement('div');
        div.innerHTML = str;
        while (div.children.length > 0) {
          el.appendChild(div.children[0]);
        }
      }

      getCookie("purecookieDismiss") || (appendHtml(document.body, '<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieDesc"><p>' + purecookieDesc + '</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">' + purecookieButton + "</a></div></div>"), pureFadeIn("cookieConsentContainer"))
    }

    initAccessories() {
      // Check if device is mobile on resize
      window.addEventListener('resize', function () {
        UomoHelpers.isMobile = UomoHelpers.updateDeviceSize();
      });
    }

    initMultiSelect() {
      // Declare variables
      const $containers = document.querySelectorAll('.multi-select');

      this._initMultiSelect($containers);
    }

    _initMultiSelect($containers) {
      $containers.forEach(el => {
        const $component = el;
        const $list = el.querySelector('.multi-select__list');
        const $select = $component.querySelector('select');
        const $actor = $component.querySelector('.multi-select__actor');

        /**
         * Change hero value when selecting item
         */
        const $selectArray = $component.querySelectorAll('.js-multi-select');
        $selectArray.forEach(el => {
          el.addEventListener('click', function (e) {
            e.preventDefault();

            const optionIndex = (Array.prototype.indexOf.call($list.children, e.currentTarget)).toString();
            const selectedOption = $select.options[optionIndex];

            if (selectedOption && !selectedOption.selected) {
              e.currentTarget.classList.add('mult-select__item_selected');
              selectedOption.selected = true;
            } else {
              e.currentTarget.classList.remove('mult-select__item_selected');
              selectedOption.selected = false;
            }

            if ($actor && !$actor.classList.contains('js-no-update')) {
              let content = $actor.dataset.placeholder;
              if ($select.selectedIndex > -1) {
                content = '';
                for (let i = 0; i < $select.selectedOptions.length; i++) {
                  const $option = $select.selectedOptions[i];
                  content = content + $option.innerText;
                  if (i < $select.selectedOptions.length - 1) {
                    content = content + ', ';
                  }
                }
              }

              $actor.innerText = content;
            }
          });
        });
      });
    }

    initBsTooltips() {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        // eslint-disable-next-line no-undef
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
    }

    initRangeSlider() {
      const selectors = {
        elementClass: '.price-range-slider',
        minElement: '.price-range__min',
        maxElement: '.price-range__max'
      }

      document.querySelectorAll(selectors.elementClass).forEach($se => {
        // $se = sliderElement
        const currency = $se.dataset.currency;

        if ($se) {
          // eslint-disable-next-line no-undef
          const priceRange = new Slider($se, {
            tooltip_split: true,
            formatter: function (value) {
              return currency + value;
            },
          });

          priceRange.on('slideStop', (value) => {
            const $minEl = $se.parentElement.querySelector(selectors.minElement);
            const $maxEl = $se.parentElement.querySelector(selectors.maxElement);
            $minEl.innerText = currency + value[0];
            $maxEl.innerText = currency + value[1];
          });
        }
      });
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Init theme
    UomoHelpers.isMobile = UomoHelpers.updateDeviceSize();
    new Uomo();
  });

  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    var paneTarget = $(e.target).attr('href');
    var $thePane = $('.tab-pane' + paneTarget);
    if ($thePane.find('.swiper-container').length > 0 && 0 === $thePane.find('.swiper-slide-active').length) {
      document.querySelectorAll('.tab-pane' + paneTarget + ' .swiper-container').forEach(function (item) {
        item.swiper.update();
        item.swiper.lazy.load();
      });
    }
  });

  $('#quickView.modal').on('shown.bs.modal', function (e) {
    var paneTarget = "#quickView";
    var $thePane = $('.modal' + paneTarget);
    if ($thePane.find('.swiper-container').length > 0 && 0 === $thePane.find('.swiper-slide-active').length) {
      document.querySelectorAll('.modal' + paneTarget + ' .swiper-container').forEach(function (item) {
        item.swiper.update();
        item.swiper.lazy.load();
      });
    }
  });

  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl, { 'html': true })
  });


  $(document).on('click', '.cart-table .remove-cart', function (e) {
    e.preventDefault();

    let parentEl = $(this).closest('tr');
    $(parentEl).addClass('_removed');
    setTimeout(() => {
      $(parentEl).remove();
    }, 350);
  });

  document.querySelector('.js-show-register').addEventListener('click', function (e) {
    document.querySelector(this.getAttribute("href")).click();
  });

  $(document).on('click', 'button.js-add-wishlist, a.add-to-wishlist', function () {
    if ($(this).hasClass("active"))
      $(this).removeClass("active");
    else
      $(this).addClass("active");
    return false;
  });

  if ($('[data-fancybox="gallery"]').length > 0) {
    $('[data-fancybox="gallery"]').fancybox({
      backFocus: false
    });
  }

  $(window).on("scroll", function () {
    if ($(".mobile_fixed-btn_wrapper").length > 0) {
      if ($(this).width() < 992 && $(this).width() >= 768) {
        if ($(this).scrollTop() + $(this).height() - 76 <= $(".mobile_fixed-btn_wrapper").offset().top && $(this).scrollTop() > $(this).height()) {
          $(".mobile_fixed-btn_wrapper > .button-wrapper").addClass("fixed-btn");
        } else {
          $(".mobile_fixed-btn_wrapper > .button-wrapper").removeClass("fixed-btn");
        }
      } else if ($(this).width() < 768) {
        if ($(this).scrollTop() + $(this).height() - 124 <= $(".mobile_fixed-btn_wrapper").offset().top && $(this).scrollTop() > $(this).height()) {
          $(".mobile_fixed-btn_wrapper > .button-wrapper").addClass("fixed-btn");
        } else {
          $(".mobile_fixed-btn_wrapper > .button-wrapper").removeClass("fixed-btn");
        }
      } else {
        $(".mobile_fixed-btn_wrapper > .button-wrapper").removeClass("fixed-btn");
      }
    }
  });

  window.onload = () => {
    if ($("#newsletterPopup").length > 0)
      $("#newsletterPopup").modal("show");

    $('.btn-video-player').each(function () {
      $(this).on("click", function () {
        if ($(this).hasClass("playing")) {
          $(this).removeClass("playing");
          $($(this).data("video")).get(0).pause();
        } else {
          $(this).addClass("playing");
          $($(this).data("video")).get(0).play();
        }
      });

      const btn_player = $(this);

      $($(this).data("video")).on("ended", function () {
        $(btn_player).removeClass("playing");
        this.currentTime = 0;
      });
    });
  }
})($);

(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.querySelectorAll("input[data-cf-pwd]").forEach(function (el) {
          if (form.querySelector(el.getAttribute("data-cf-pwd")).value != el.value) {
            event.preventDefault();
            event.stopPropagation();
          }
        });

        form.classList.add('was-validated')
      }, false);

      form.querySelectorAll("input[data-cf-pwd]").forEach(function (el) {
        el.addEventListener('keyup', function (event) {
          if (!el.value || form.querySelector(el.getAttribute("data-cf-pwd")).value != el.value) {
            el.classList.add("is-invalid");
            el.classList.remove("is-valid");
            el.setCustomValidity("Invalid field.");
          } else {
            el.classList.remove("is-invalid");
            el.classList.add("is-valid");
            el.setCustomValidity("");
          }
        });
        form.querySelector(el.getAttribute("data-cf-pwd")).addEventListener('keyup', function (event) {
          if (!el.value || form.querySelector(el.getAttribute("data-cf-pwd")).value != el.value) {
            el.classList.add("is-invalid");
            el.classList.remove("is-valid");
            el.setCustomValidity("Invalid field.");
          } else {
            el.classList.remove("is-invalid");
            el.classList.add("is-valid");
            el.setCustomValidity("");
          }
        });
      });
    });
})();

window.addEventListener('load', () => {
  try {
    let url = window.location.href.split('#').pop();
    document.querySelector('#' + url).click();
  } catch {

  }
});

function changeMainImage(imageUrl, selectedThumbnail) {
  const mainImage = document.getElementById('mainImage');
  mainImage.src = imageUrl;

  const thumbnails = document.querySelectorAll('.thumbnail');

  // Đặt opacity cho tất cả hình ảnh thumbnail thành 0.5

  thumbnails.forEach(thumbnail => {
    thumbnail.style.opacity = 0.5;
  });
  selectedThumbnail.style.opacity = 1;

  // Đặt opacity của hình ảnh được chọn thành 1
}

document.addEventListener('DOMContentLoaded', function () {

  // Hàm để lấy ID sản phẩm từ URL
  function getProductIdFromUrl() {
    const url = window.location.href;
    const match = url.match(/\/product\/(\d+)/);
    return match ? match[1] : null;
  }

  // Lấy ID sản phẩm từ URL
  const currentProductId = getProductIdFromUrl();

  // Hàm để lấy thông tin chi tiết của sản phẩm từ server
  function fetchProductDetails(productId) {
    return fetch(`/search-product?product_id=${productId}`) // Gọi phương thức search
      .then(response => {
        if (!response.ok) {
          throw new Error('Không thể lấy thông tin sản phẩm');
        }
        return response.json();
      })
      .then(data => {
        console.log('Dữ liệu trả về từ server:', data); // Log dữ liệu trả về từ server
        // Trả về thông tin sản phẩm nếu thành công
        if (data.success) {
          const product = data.product;

          return product;
        } else {
          return null;
        }
      })
      .catch(error => {
        return null; // Trả về null nếu có lỗi
      });
  }

  function changeImage(imageSrc) {
    const mainImg = document.getElementById('main-img');
    if (mainImg) {
      mainImg.src = imageSrc;
    } else {
      console.error('Phần tử main-img không tồn tại');
    }
  }

  //Lấy thông tin chi tiết của sản phẩm 1 và cập nhật vào HTML
  if (currentProductId) {
    fetchProductDetails(currentProductId).then(product => {
      if (product) {
        // Lấy giá trị từ productSizeColors
        const price = product.productSizeColors ? product.productSizeColors.price : 'N/A';
        const quanlity = product.productSizeColors ? product.productSizeColors.quantily : 'N/A';
        console.log(`Giá sản phẩm: ${price}`); // Log giá sản phẩm
        console.log('Thông tin sản phẩm đã được cập nhật');
        document.getElementById('product1-name').textContent = product.name;
        console.log(`Tên sản phẩm 1: ${product.name}`); // Log tên sản phẩm 1

        const productDetails = `
            <div class="product-details product-1">
                <div><strong>Name:</strong> ${product.name}</div>
                <div><strong>Description:</strong> ${product.description}</div>
                <div><strong>Price:</strong> ${price}</div>
                <div><strong>Quantity:</strong> ${quanlity}</div>
            </div>          
          `;
        console.log('Product 1 Details:', productDetails); // Log dữ liệu của productDetails
        document.querySelector('.details-card.product-1 span').innerHTML = productDetails;
      }
    });
  }

  // Sự kiện click cho button "Comparison"
  document.querySelector('.comparison-button').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('comparison-table').classList.toggle('d-none');
  });

  // Sự kiện click cho nút "Đóng" trong bảng so sánh
  document.querySelectorAll('.close-btn').forEach(function (button) {
    button.addEventListener('click', function () {
      // Ẩn bảng so sánh
      document.querySelector('.comparison-section').classList.add('d-none');
      document.getElementById('comparison-table').classList.add('d-none');
    });
  });
  // Sự kiện click cho nút "Thêm sản phẩm"
  document.querySelector('.btn-add-product').addEventListener('click', function (event) {
    event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
    const modal = document.getElementById('add-product-modal');
    modal.classList.remove('d-none'); // Xóa lớp d-none để hiển thị modal
    console.log('Modal đã được hiển thị:', modal.classList); // Xem lớp hiện tại của modal
  });
  // Sự kiện click cho nút "Đóng" trong modal "Add Product"
  document.querySelector('.close').addEventListener('click', function () {
    console.log('Nút đóng đã được nhấn');
    const modal = document.getElementById('add-product-modal');
    modal.classList.add('d-none');
    console.log('Modal đã bị ẩn:', modal.classList);
  });
  // Sự kiện nhập tên tìm kiếm sản phẩm
  document.getElementById('product-search').addEventListener('input', function (event) {
    const query = event.target.value;
    const resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Xóa kết quả trước đó

    if (query) {
      fetch(`/search-product?product_name=${query}`) // URL phải đúng với route
        .then(response => {
          console.log('Trạng thái phản hồi:', response.status); // Log trạng thái phản hồi
          if (!response.ok) {
            throw new Error('Phản hồi mạng không thành công');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            const product = data.product;
            const resultItem = document.createElement('div');
            resultItem.classList.add('search-result-item');
            resultItem.innerHTML = `
                          <span>${product.name}</span>
                          <button class="btn-add" data-product-id="${product.product_id}" data-product-name="${product.name}">Thêm sản phẩm</button>
                      `;
            resultsContainer.appendChild(resultItem);
          } else {
            resultsContainer.innerHTML = '<div class="search-result-item">Không tìm thấy sản phẩm</div>';
          }
        })
        .catch(error => {
          console.error('Có lỗi xảy ra:', error);
          resultsContainer.innerHTML = '<div class="search-result-item">Không tìm thấy sản phẩm</div>';
        });
    }
  });


  // Chức năng thêm sản phẩm vào mục so sánh
  document.getElementById('search-results').addEventListener('click', function (event) {
    console.log('Kết quả tìm kiếm đã được nhấn'); // Log khi kết quả tìm kiếm được nhấn
    if (event.target.classList.contains('btn-add')) {
      console.log('Nút thêm sản phẩm đã được nhấn'); // Log khi nút thêm sản phẩm được nhấn
      const product2name = event.target.getAttribute('data-product-name');
      const product2Id = event.target.getAttribute('data-product-id');
      console.log('Tên sản phẩm:', product2name); // Log tên sản phẩm
      console.log('ID sản phẩm:', product2Id); // Log ID sản phẩm

      // Kiểm tra nếu productId là null hoặc undefined
      if (!product2Id) {
        console.error('ID sản phẩm không hợp lệ:', product2Id);
        return;
      }

      // Cập nhật modal so sánh với tên sản phẩm
      document.getElementById('product-name').textContent = product2name;
      document.getElementById('add-product-modal').classList.add('d-none'); // Ẩn modal

      // Lấy thông tin chi tiết của sản phẩm 2 và cập nhật vào HTML
      if (product2Id) {
        fetchProductDetails(product2Id).then(product => {
          if (product) {
            // Lấy giá trị price từ productSizeColors
            const price = product.productSizeColors ? product.productSizeColors.price : 'N/A';
            const quanlity = product.productSizeColors ? product.productSizeColors.quantily : 'N/A';
            const product2Details = `
                        <div class="product-details product-2">
                            <div><strong>Name:</strong> ${product.name}</div>\
                            <div><strong>Description:</strong> ${product.description}</div>\
                            <div><strong>Price:</strong> ${price}</div>\
                            <div><strong>Quantity:</strong> ${quanlity}</div>\
                        </div>
                      `;
            document.querySelector('.details-card.product-2 span').innerHTML = product2Details;
            if (product.images.length > 0) {
              const product2Img = document.querySelector('#product2-card img');
              if (product2Img) {
                product2Img.src = `/assets/img/products/${product.images[0]}`;
                product2Img.alt = product.name;
                console.log('Hình ảnh sản phẩm 2 đã được cập nhật:', product2Img.src); // Log hình ảnh sản phẩm 2
              }
            } else {
              console.log('Không có hình ảnh cho sản phẩm 2 hoặc thuộc tính image_url không tồn tại');
            }
          }
        });
      }

      // Tạo thẻ h2 chứa tên sản phẩm và thêm vào div.comparison-item.product2
      const comparisonItem = document.querySelector('.comparison-item.product2');
      if (comparisonItem) {
        const productH2 = document.createElement('h2');
        productH2.textContent = product2name;
        productH2.setAttribute('data-product-id', product2Id); // Lưu trữ product_id trong thuộc tính data-
        comparisonItem.appendChild(productH2);
        console.log('Sản phẩm đã được thêm vào mục so sánh với ID:', product2Id); // Log khi sản phẩm được thêm

        // Ẩn nút "Thêm sản phẩm"
        const addButton = comparisonItem.querySelector('.btn-add-product');
        if (addButton) {
          addButton.style.display = 'none';
          console.log('Nút thêm sản phẩm đã bị ẩn'); // Log khi nút thêm sản phẩm bị ẩn
        } else {
          console.log('Không tìm thấy nút thêm sản phẩm để ẩn'); // Log nếu không tìm thấy nút thêm sản phẩm
        }

        // Cập nhật tên sản phẩm trong phần tử .product-wrapper
        document.getElementById('product2-name').textContent = product2name;
        document.getElementById('product2-name').setAttribute('data-product-id', product2Id);
        console.log(`Product 2 - ID: ${product2Id}, Name: ${product2name}`); // Log ID và tên của sản phẩm 2
      } else {
        console.log('Không tìm thấy phần tử comparison-item.product2'); // Log nếu không tìm thấy phần tử comparison-item.product2
      }
    }
  });

  // Chức năng xóa tất cả sản phẩm khỏi mục so sánh
  document.querySelector('.comparison-item.btn-comparsion').addEventListener('click', function (event) {
    if (event.target.classList.contains('delete-product')) {
      console.log('Nút xóa tất cả sản phẩm đã được nhấn'); // Log khi nút xóa tất cả sản phẩm được nhấn

      // Xóa tất cả thẻ h2 chứa tên sản phẩm và thuộc tính data-product-id
      const comparisonItems = document.querySelectorAll('.comparison-item.product2 h2');
      comparisonItems.forEach(function (item) {
        const productId = item.getAttribute('data-product-id');
        item.remove();
        console.log('Sản phẩm với ID', productId, 'đã được xóa khỏi mục so sánh'); // Log khi sản phẩm được xóa
      });

      // Hiển thị lại nút "Thêm sản phẩm"
      const addButtons = document.querySelectorAll('.comparison-item.product2 .btn-add-product');
      addButtons.forEach(function (button) {
        button.style.display = 'block';
        console.log('Nút thêm sản phẩm đã được hiển thị lại'); // Log khi nút thêm sản phẩm được hiển thị lại
      });
      // Đặt lại tên sản phẩm trong phần tử .product-wrapper
      document.getElementById('product2-name').textContent = 'Sản phẩm 2';
      document.getElementById('product2-name').removeAttribute('data-product-id');
    }
  });

  // Sự kiện click cho nút "So sánh ngay"
  document.querySelector('.btn-table.comparsion').addEventListener('click', function (event) {
    event.preventDefault();

    // Kiểm tra nếu không có sản phẩm nào được thêm vào mục so sánh
    const comparisonItem = document.querySelector('.comparison-item.product2');
    if (comparisonItem && comparisonItem.querySelectorAll('h2').length === 0) {
      alert('Vui lòng thêm sản phẩm so sánh');
      return;
    }

    // Hiển thị bảng so sánh
    document.querySelector('.comparison-section').classList.remove('d-none');

    // Đóng modal "Add Product"
    document.getElementById('add-product-modal').classList.add('d-none');
  });

  // Sự kiến chatbox online
  document.querySelector('.chatbox-toggle').addEventListener('click', function () {
    document.querySelector('.chatbox-content').classList.toggle('active');
    document.querySelector('.chatbox-toggle').classList.toggle('d-none');
    console.log('Nút chatbox-toggle đã được nhấn');
  });

  document.querySelector('.close-chatbox').addEventListener('click', function () {
    document.querySelector('.chatbox-content').classList.remove('active');
    document.querySelector('.chatbox-toggle').classList.remove('d-none');
    console.log('Nút close-chatbox đã được nhấn');
  });
});

// Xoá sản phẩm khỏi giỏ hàng
document.addEventListener('DOMContentLoaded', function () {
  const removeButtons = document.querySelectorAll('.remove-cart');

  removeButtons.forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();

      const cartItemId = button.getAttribute('data-id');

      if (cartItemId) {
        fetch(`cart/remove/${cartItemId}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
          }
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Xóa dòng sản phẩm khỏi giao diện
              button.closest('tr').remove();
              alert('Item removed from cart');
              // Cập nhật lại tổng phụ
              updateSubtotal();
            } else {
              alert('Failed to remove item from cart');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
          });
      }
    });
  });
});

// Cập nhật giỏ hàng
// document.getElementById('update-cart').addEventListener('click', function () {
//   // Tạo một đối tượng FormData
//   const formData = new FormData();

//   // Thu thập tất cả các số lượng từ các ô input
//   const quantities = document.querySelectorAll('input[name^="quantity"]');
//   quantities.forEach(input => {
//     const cartItemId = input.dataset.id; // Lấy cartItemId từ data attribute
//     formData.append(`quantity[${cartItemId}]`, input.value);
//   });

//   // Gửi yêu cầu cập nhật giỏ hàng
//   fetch('cart/update', {
//     method: 'PUT',
//     headers: {
//       'X-CSRF-TOKEN': '{{ csrf_token() }}', // Nếu bạn cần CSRF token
//     },
//     body: formData,
//   })
//     .then(response => response.json())
//     .then(data => {
//       // Xử lý phản hồi từ server
//       if (data.success) {
//         alert(data.message); // Thông báo thành công
//         // Cập nhật lại nội dung giỏ hàng nếu cần
//       } else {
//         alert('Failed to update cart.'); // Thông báo thất bại
//       }
//     })
//     .catch(error => {
//       console.error('Error:', error);
//       alert('An error occurred while updating the cart.');
//     });
// });

//product detail
document.addEventListener('DOMContentLoaded', function () {
  // Lắng nghe sự kiện thay đổi trên các phần tử size và color
  document.querySelectorAll('input[name="size_id"], input[name="color_id"]').forEach(function(element) {
      element.addEventListener('change', function() {
          const selectedSize = document.querySelector('input[name="size_id"]:checked');
          const selectedColor = document.querySelector('input[name="color_id"]:checked');
          const productId = document.getElementById('product-info').getAttribute('data-product-id');

          let quantity = 0;
          let price = 0;

          if (selectedSize && selectedColor) {
              // Gửi yêu cầu AJAX đến server để lấy số lượng
              fetch(`/api/product/quantity?product_id=${productId}&size_id=${selectedSize.id.split('-')[2]}&color_id=${selectedColor.id.split('-')[2]}`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      return response.json();
                  })
                  .then(data => {
                      console.log(data); // Kiểm tra dữ liệu trả về
                      quantity = data.quantity ?? 0;
                      price = data.price ?? 0;
                      document.getElementById('product-quantity').textContent = quantity;
                      let formattedPrice = new Intl.NumberFormat('vi-VN').format(price) + ' VND';
                      document.getElementById('product-price').textContent = formattedPrice;                      
                  })
                  .catch(error => {
                      console.error('Error fetching quantity:', error);
                      document.getElementById('product-quantity').textContent = 0; 
                  });
          } else {
              document.getElementById('product-quantity').textContent = 0;
          }
      });
  });
});

// Thêm vào giỏ hàng
$(document).ready(function() {
  $('#add-to-cart-btn').click(function(e) {
      e.preventDefault(); // Ngừng hành động mặc định của form (submit)
      
      var form = $('#add-to-cart-form'); // Lấy form
      var formData = form.serialize(); // Lấy dữ liệu từ form
      console.log(formData);
      
      $.ajax({
          url: form.attr('action'), // Lấy URL từ thuộc tính action của form
          type: 'POST',
          data: formData, // Dữ liệu cần gửi
          success: function(response) {
              // Nếu thêm vào giỏ hàng thành công
              alert('Add to cart successfully!');
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText); // In ra chi tiết lỗi trả về từ server
              // Nếu có lỗi xảy ra
              alert('An error occurred while adding the product to the cart!');
          }
      });
  });
});

// Cập nhật giỏ hàng
$(document).ready(function () {
  $('#update-cart').click(function (e) {
      e.preventDefault(); // Ngừng hành động mặc định của button (submit)

      var updatedData = [];
      var isValid = true;

      // Lặp qua mỗi dòng sản phẩm trong giỏ hàng
      $('.cart-table tbody tr').each(function () {
          var cartItemId = $(this).data('cart-item-id'); // Lấy cart_item_id từ data attribute
          var quantity = $(this).find('input[name="quantity[' + cartItemId + ']"]').val(); // Lấy quantity

          // Kiểm tra quantity (phải là số nguyên dương lớn hơn 0)
          if (!quantity || isNaN(quantity) || quantity <= 0) {
              alert('The quantity must be a positive integer and greater than 0!');
              isValid = false;
              return false; // Thoát khỏi vòng lặp each
          }

          // Thêm dữ liệu của sản phẩm vào mảng
          updatedData.push({
              cart_item_id: cartItemId,
              quantity: quantity
          });
      });

      // Nếu dữ liệu không hợp lệ, dừng việc gửi request
      if (!isValid) {
          return;
      }

      // Gửi AJAX request để cập nhật giỏ hàng
      $.ajax({
          url: '/cart/update', // URL endpoint cập nhật giỏ hàng
          type: 'PUT',
          data: {
              _token: $('meta[name="csrf-token"]').attr('content'), // Thêm CSRF token để bảo mật
              updatedData: updatedData // Gửi dữ liệu đã thu thập
          },
          success: function (response) {
              alert('Update cart successfully!');
              var newTotal = 0;

              // Cập nhật lại số lượng sản phẩm trong giỏ hàng và tính tổng số tiền
              $('.cart-table tbody tr').each(function () {
                  var cartItemId = $(this).data('cart-item-id');
                  var updatedQuantity = $('input[name="quantity[' + cartItemId + ']"]').val();
                  var price = parseFloat($(this).find('.shopping-cart__product-price').text().replace(' VND', '').replace(/\./g, ''));
                  var subtotal = updatedQuantity * price;
                  $(this).find('.shopping-cart__subtotal').text(subtotal + ' VND');
                  newTotal += subtotal;
              });

              // Cập nhật tổng số tiền
              $('#subtotal').text(newTotal + ' VND');
              calculateTotal(); // Hàm tính tổng số tiền
          },
          error: function (xhr, status, error) {
              // Nếu có lỗi
              alert('An error occurred while updating the cart!');
          }
      });
  });
});


// Hàm tính toán lại tổng tiền
function calculateTotal() {
  const subtotalElement = document.getElementById('subtotal');
  const voucherSelect = document.getElementById('voucher-select');
  const totalElement = document.getElementById('total');
  const shippingOptions = document.querySelectorAll('input[name="shipping"]:checked');

  if (subtotalElement && totalElement) {
    const subtotal = parseFloat(subtotalElement.textContent.replace(/,/g, '').replace(' VND', ''));
    let voucherDiscount = 0;
    if (voucherSelect) {
      const selectedVoucher = voucherSelect.options[voucherSelect.selectedIndex];
      voucherDiscount = selectedVoucher && selectedVoucher.value !== "" ? parseFloat(selectedVoucher.getAttribute('data-discount')) : 0;
    }
    const shippingCost = shippingOptions.length > 0 ? parseFloat(shippingOptions[0].value) : 0; // Lấy giá trị của tùy chọn vận chuyển đang được chọn

    const totalBeforeDiscount = subtotal + shippingCost;
    const total = totalBeforeDiscount - (totalBeforeDiscount * voucherDiscount / 100);

    totalElement.textContent = `${total} VND`;
  } else {
    console.log('One or more elements not found for total calculation');
  }
}

// Hàm tính toán lại tổng phụ
function updateSubtotal() {
  const cartItems = document.querySelectorAll('.cart-item');
  let subtotal = 0;

  cartItems.forEach(function(item) {
    const priceElement = item.querySelector('.shopping-cart__product-price'); // Giả sử mỗi sản phẩm có lớp .shopping-cart__product-price
    const price = parseFloat(priceElement.textContent.replace(/,/g, '').replace(' VND', ''));
    const quantityElement = item.querySelector('input[name="quantity[' + item.dataset.cartItemId + ']"]');
    const quantity = parseInt(quantityElement.value);
    const itemSubtotal = quantity * price;
    item.querySelector('.shopping-cart__subtotal').textContent = itemSubtotal + ' VND';
    subtotal += itemSubtotal;
  });

  if (cartItems.length === 0) {
      subtotal = 0;
  }

  document.getElementById('subtotal').textContent = subtotal + ' VND';
  document.getElementById('total').textContent = subtotal + ' VND'; // Cập nhật tổng số tiền nếu cần
}


// Tổng tiền giỏ hàng
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOMContentLoaded event fired');

  
  calculateTotal();

  const voucherSelect = document.getElementById('voucher-select');

  voucherSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const voucherName = selectedOption.getAttribute('data-name');
      const voucherDiscount = selectedOption.getAttribute('data-discount');

      if (voucherName && voucherDiscount) {
          const voucherInfo = document.getElementById('voucher-info');
          voucherInfo.textContent = `${voucherName} - Giảm ${voucherDiscount}%`;
      } else {
          const voucherInfo = document.getElementById('voucher-info');
          voucherInfo.textContent = '';
      }

      calculateTotal();
  });

  // Kiểm tra số lượng sản phẩm trong giỏ hàng trước khi chuyển hướng đến trang thanh toán
  const checkoutButton = document.querySelector('.btn-checkout-cart');
  if (checkoutButton) {
    checkoutButton.addEventListener('click', function(event) {
      event.preventDefault(); // Ngăn chặn hành động mặc định của nút

      // Kiểm tra số lượng sản phẩm trong giỏ hàng
      const cartItems = document.querySelectorAll('.cart-item'); // Giả sử các sản phẩm trong giỏ hàng có lớp .cart-item
      console.log('Cartitems', cartItems);

      if (cartItems.length > 0) {
          // Nếu có sản phẩm trong giỏ hàng, chuyển hướng đến trang thanh toán
          const checkoutUrl = checkoutButton.getAttribute('data-url');
          window.location.href = checkoutUrl; // Sử dụng URL đã được truyền từ Blade
      } else {
          // Nếu không có sản phẩm nào, hiển thị thông báo
          alert("Please add product to cart!");
      }
    });
  } else {
    console.error('Checkout button not found');
  }
});

// Tổng tiền checkout
function calculateCheckoutTotal() {
  const subtotalElement = document.getElementById('subtotal');
  const voucherSelect = document.getElementById('voucher-select');
  const totalElement = document.getElementById('total-amount'); // Đảm bảo ID này khớp với phần tử trong HTML
  const shippingOptions = document.querySelectorAll('input[name="shipping"]:checked');

  if (subtotalElement && voucherSelect && totalElement && shippingOptions.length > 0) {
      const subtotal = parseFloat(subtotalElement.textContent.replace(/,/g, '').replace(' VND', ''));
      const selectedVoucher = voucherSelect.options[voucherSelect.selectedIndex];
      const voucherDiscount = selectedVoucher && selectedVoucher.value !== "" ? parseFloat(selectedVoucher.getAttribute('data-discount')) : 0;
      const shippingCost = parseFloat(shippingOptions[0].value); // Lấy giá trị của tùy chọn vận chuyển đang được chọn

      const totalBeforeDiscount = subtotal + shippingCost;
      const total = totalBeforeDiscount - (totalBeforeDiscount * voucherDiscount / 100);

      totalElement.textContent = `${total} VND`;
  } else {
      console.log('One or more elements not found for total calculation');
  }
}

// Call the function to calculate the total on page load
document.addEventListener('DOMContentLoaded', calculateCheckoutTotal);

// Optionally, you can call the function when the voucher or shipping option is changed
document.getElementById('voucher-select').addEventListener('change', calculateCheckoutTotal);
document.querySelectorAll('input[name="shipping"]').forEach(function(element) {
  element.addEventListener('change', calculateCheckoutTotal);
});


// Checkout
console.log('Checkout kết nói thành công');
document.addEventListener('DOMContentLoaded', function() {
  // Lắng nghe sự kiện click trên các mục trong danh sách quốc gia
  document.querySelectorAll('.search-suggestion__item.js-search-select').forEach(function(item) {
      item.addEventListener('click', function() {
          const selectedCountry = this.textContent.trim();
          document.getElementById('selected-country').value = selectedCountry;
          document.getElementById('country-error').textContent = ''; // Xóa thông báo lỗi cũ
      });
  });

  document.querySelector('.btn-checkout').addEventListener('click', function(event) {
      const firstName = document.getElementById('checkout_first_name').value.trim();
      const lastName = document.getElementById('checkout_last_name').value.trim();
      const streetAddress = document.getElementById('checkout_street_address').value.trim();
      const city = document.getElementById('checkout_city').value.trim();
      const zipcode = document.getElementById('checkout_zipcode').value.trim();
      const phone = document.getElementById('checkout_phone').value.trim();
      const email = document.getElementById('checkout_email').value.trim();
      const selectedPaymentMethod = document.querySelector('input[name="checkout_payment_method"]:checked');
      const paymentMethodLabel = selectedPaymentMethod.nextElementSibling.textContent.trim();
      const selectedCountry = document.getElementById('selected-country').value.trim();
      
      const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');
      const namePattern = /^[A-Za-zÀ-ỹà-ỹ\s]+$/; // Cho phép chữ cái và dấu tiếng Việt
      const addressPattern = /^[A-Za-zÀ-ỹà-ỹ0-9\s,\/]+$/; // Cho phép chữ cái, số, dấu tiếng Việt, dấu "," và "/"
      const zipcodePattern = /^\d+$/; // Chỉ cho phép số
      const phonePattern = /^\d{10}$/; // Chỉ cho phép 10 chữ số
      const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; // Định dạng email phải có @gmail.com

      

        // Xóa thông báo lỗi cũ
        const errorFields = [
          'first-name-error',
          'last-name-error',
          'street-address-error',
          'city-error',
          'zipcode-error',
          'province-error',
          'phone-error',
          'email-error',
          'country-error'
      ];

      errorFields.forEach(function(field) {
          const errorElement = document.getElementById(field);
          if (errorElement) {
              errorElement.textContent = '';
          }
      });

      let hasError = false;

      // Kiểm tra firstName
      if (!firstName) {
          document.getElementById('first-name-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!namePattern.test(firstName)) {
          document.getElementById('first-name-error').textContent = 'Không nhập số và ký tự đặc biệt';
          hasError = true;
      }

      // Kiểm tra lastName
      if (!lastName) {
          document.getElementById('last-name-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!namePattern.test(lastName)) {
          document.getElementById('last-name-error').textContent = 'Không nhập số và ký tự đặc biệt';
          hasError = true;
      }

      // Kiểm tra streetAddress
      if (!streetAddress) {
          document.getElementById('street-address-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!addressPattern.test(streetAddress)) {
          document.getElementById('street-address-error').textContent = 'Không nhập ký tự đặc biệt ngoại trừ "," và "/"';
          hasError = true;
      }

      // Kiểm tra city
      if (!city) {
          document.getElementById('city-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!addressPattern.test(city)) {
          document.getElementById('city-error').textContent = 'Không nhập ký tự đặc biệt ngoại trừ "," và "/"';
          hasError = true;
      }

      // Kiểm tra zipcode
      if (!zipcode) {
          document.getElementById('zipcode-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!zipcodePattern.test(zipcode)) {
          document.getElementById('zipcode-error').textContent = 'Chỉ nhập số';
          hasError = true;
      }

      // Kiểm tra phone
      if (!phone) {
          document.getElementById('phone-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!phonePattern.test(phone)) {
          document.getElementById('phone-error').textContent = 'Chỉ nhập số và đủ 10 số';
          hasError = true;
      }

      // Kiểm tra email
      if (!email) {
          document.getElementById('email-error').textContent = 'Không được bỏ trống';
          hasError = true;
      } else if (!emailPattern.test(email)) {
          document.getElementById('email-error').textContent = 'Email phải có định dạng @gmail.com';
          hasError = true;
      }

      // Kiểm tra selectedCountry
      if (!selectedCountry) {
          document.getElementById('country-error').textContent = 'Vui lòng chọn quốc gia';
          hasError = true;
      }
      console.log('Bắt đầu kiểm tra lỗi');
      console.log('Giá trị của hasError:', hasError);
      if (!hasError) {
        console.log('Bắt đầu gửi form đến server');
        const orderItems = [];
        const cartItems = document.querySelectorAll('.checkout-cart-items tbody tr');
        const cartItemIds = [];
    
        cartItems.forEach((row, index) => {
            const cartItemId = row.getAttribute('data-cart-item-id');
            cartItemIds.push(cartItemId);
    
            // Gửi yêu cầu AJAX để lấy thông tin sản phẩm dựa vào cart_item_id
            fetch(`/cart-items/${cartItemId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Dữ liệu trả về từ server:', data); // Kiểm tra dữ liệu trả về
    
                    data.products.forEach(product => {
                        orderItems.push({
                            product_id: product.product_id, // Lấy product_id từ dữ liệu trả về
                            size_id: product.size_id, // Lấy size_id từ dữ liệu trả về
                            color_id: product.color_id, // Lấy color_id từ dữ liệu trả về
                            quantity: product.quantity,
                            price: product.price * product.quantity
                        });
                    });
    
                    console.log('Danh sách sản phẩm:', orderItems);
    
                    // Sau khi lấy xong tất cả sản phẩm, gửi dữ liệu đến server
                    if (orderItems.length === cartItems.length) {
                        const noteElement = document.querySelector('textarea[name="note"]');
                        const data = {
                            user_id: userId,
                            first_name: firstName,
                            last_name: lastName,
                            country: selectedCountry,
                            street_address: streetAddress,
                            city: city,
                            zipcode: zipcode,
                            phone: phone,
                            email: email,
                            subtotal: parseFloat(document.getElementById('subtotal').textContent.replace(/,/g, '')),
                            shipping_price: parseFloat(document.querySelector('input[name="shipping"]:checked').value),
                            total: parseFloat(document.getElementById('total-amount').textContent.replace(/,/g, '')),
                            payment_method: paymentMethodLabel,
                            voucher_id: document.getElementById('voucher-select').value || null,
                            note: noteElement ? noteElement.value : null,
                            order_items: orderItems
                        };
    
                        fetch('/orders', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:', data);
                            if (data.success) {
                                // Xóa tất cả sản phẩm ra khỏi giỏ hàng trong cơ sở dữ liệu
                                fetch('/cart/clear', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({ cart_item_ids: cartItemIds })
                                })
                                .then(() => {
                                    // Chuyển hướng sang trang xác nhận đơn hàng
                                    window.location.href = `/checkout/confirmation/${data.order_id}`;
                                })
                                .catch((error) => {
                                    console.error('Error clearing cart:', error);
                                    // Chuyển hướng sang trang xác nhận đơn hàng ngay cả khi xóa giỏ hàng thất bại
                                    window.location.href = `/checkout/confirmation/${data.order_id}`;
                                });
                            } else {
                                alert(data.error);
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('An error occurred while placing the order. Please try again.');
                        });
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    }
  }); 
});

document.addEventListener("DOMContentLoaded", function() {
  // Lấy các phần tử cần thiết
  const bankingInfoSection = document.getElementById("banking-info-section");
  const paymentMethodRadios = document.querySelectorAll('input[name="checkout_payment_method"]');
  const bankTransferRadio = document.getElementById("checkout_payment_method_1");

  // Hàm để hiển thị hoặc ẩn bankingInfoSection
  function toggleBankingInfoSection() {
      if (bankTransferRadio.checked) {
          bankingInfoSection.hidden = false; // Hiển thị
      } else {
          bankingInfoSection.hidden = true; // Ẩn đi
      }
  }

  // Ẩn bankingInfoSection khi trang được tải
  toggleBankingInfoSection();

  // Lắng nghe sự kiện thay đổi trên các radio button
  paymentMethodRadios.forEach((radio) => {
      radio.addEventListener("change", toggleBankingInfoSection);
  });
});
document.addEventListener("DOMContentLoaded", function() {
  const bankingInfoSection = document.getElementById("banking-info-section");
  const paymentMethodRadios = document.querySelectorAll('input[name="checkout_payment_method"]');
  const bankTransferRadio = document.getElementById("checkout_payment_method_1");

  function toggleSections() {
      if (bankTransferRadio.checked) {
          // Hiển thị bảng thông tin ngân hàng và email khi chọn Direct bank transfer
          bankingInfoSection.classList.remove("d-none");
      } else {
          // Ẩn bảng thông tin ngân hàng và email khi chọn phương thức khác
          bankingInfoSection.classList.add("d-none");
      }
  }

  // Gọi hàm kiểm tra trạng thái ban đầu
  toggleSections();

  // Lắng nghe sự kiện thay đổi trên radio button
  paymentMethodRadios.forEach((radio) => {
      radio.addEventListener("change", toggleSections);
  });
});

document.addEventListener('DOMContentLoaded', function () {
  // Lấy các phần tử từ form
  const addBankCardBtn = document.getElementById('add-bank-card-btn');
  const bankCardTable = document.getElementById('bank-card-table');
  const bankSelect = bankCardTable.querySelector('select');
  const cardNumberInput = bankCardTable.querySelector('input[placeholder="Nhập số thẻ..."]');
  const cardHolderInput = bankCardTable.querySelector('input[placeholder="Nhập họ tên..."]');
  const issueDateInput = bankCardTable.querySelector('input[placeholder="dd/mm/yyyy"]');
  const expiryDateInput = bankCardTable.querySelector('input[placeholder="MM/YY"]');
  const cvvInput = bankCardTable.querySelector('input[placeholder="Nhập CVV..."]');
  const confirmButton = bankCardTable.querySelector('#add-bank-card-btn');
  const closeTableButton = bankCardTable.querySelector('#close-bank-form-btn');
  const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');
  const bankingSuggestions = document.getElementById('banking-suggestions');

  // Hàm kiểm tra số thẻ ngân hàng (từ 10 - 15 chữ số)
  function validateCardNumber(cardNumber) {
    const cardNumberRegex = /^[0-9]{10,15}$/;
    return cardNumberRegex.test(cardNumber);
  }

  // Hàm kiểm tra tên chủ thẻ (chỉ chứa chữ cái và khoảng trắng)
  function validateCardHolder(name) {
    const nameRegex = /^[a-zA-Z\s]+$/;
    return nameRegex.test(name);
  }

  // Hàm kiểm tra ngày phát hành thẻ và ngày hết hạn thẻ (định dạng dd/mm/yyyy và MM/YY)
  function validateDate(date, type = 'issue') {
    if (type === 'issue') {
      const issueDateRegex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;
      return issueDateRegex.test(date);
    } else if (type === 'expiry') {
      const expiryDateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
      return expiryDateRegex.test(date);
    }
    return false;
  }

  // Hàm kiểm tra CVV (3 chữ số)
  function validateCVV(cvv) {
    const cvvRegex = /^[0-9]{3}$/;
    return cvvRegex.test(cvv);
  }

  // Hàm hiển thị thông báo lỗi
  function showError(message) {
    alert(message);
  }

  // Hiển thị hoặc ẩn bảng khi nhấn nút "Add bank card"
  addBankCardBtn.addEventListener('click', function() {
    console.log('Nút "Add bank card" đã được nhấn');
    bankCardTable.classList.toggle('hidden-table');
    console.log('Bảng đã được hiển thị/ẩn:', bankCardTable.classList);
  });

  // Đóng form khi nhấn vào nút "Close"
  closeTableButton.addEventListener('click', function () {
    console.log('Đã được nhấn nút Close');
    bankCardTable.classList.add('hidden-table');
    console.log('Bảng đã bị ẩn:', bankCardTable.classList);
  });

  // Xử lý sự kiện khi nhấn nút "Xác nhận"
  confirmButton.addEventListener('click', function (event) {
    event.preventDefault();

    // Lấy giá trị các trường
    const selectedBank = bankSelect.value;
    const cardNumber = cardNumberInput.value.trim();
    const cardHolderName = cardHolderInput.value.trim();
    const issueDate = issueDateInput.value.trim();
    const expiryDate = expiryDateInput.value.trim();
    const cvv = cvvInput.value.trim();

    // Kiểm tra các trường
    if (!selectedBank) {
      showError('Vui lòng chọn ngân hàng.');
      return;
    }

    if (!validateCardNumber(cardNumber)) {
      showError('Vui lòng nhập số thẻ hợp lệ (10 - 15 chữ số).');
      return;
    }

    if (!validateCardHolder(cardHolderName)) {
      showError('Vui lòng nhập họ và tên chủ thẻ hợp lệ (chỉ chứa chữ cái và khoảng trắng).');
      return;
    }

    if (!validateDate(issueDate, 'issue')) {
      showError('Vui lòng nhập ngày phát hành hợp lệ (dd/mm/yyyy).');
      return;
    }

    if (!validateDate(expiryDate, 'expiry')) {
      showError('Vui lòng nhập ngày hết hạn hợp lệ (MM/YY).');
      return;
    }

    if (!validateCVV(cvv)) {
      showError('Vui lòng nhập CVV hợp lệ (3 chữ số).');
      return;
    }
      
      // Gửi dữ liệu đến server bằng AJAX
      fetch('/save-bank-account', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
              user_id: userId,  // Truyền ID người dùng hiện tại từ backend
              bank_name: selectedBank,
              card_number: cardNumber,
              card_holder_name: cardHolderName,
              issue_date: issueDate,
              expiry_date: expiryDate
          })
      })
      .then(response => {
        // Kiểm tra phản hồi từ server
        if (!response.ok) {
            throw new Error('Lỗi từ server');
        }
        return response.json();
      })
      .then(data => {
        console.log('Dữ liệu trả về từ server:', data);
          if (data.success) {
              alert(data.success);
              bankCardTable.classList.add('hidden-table');
              console.log('Bảng đã bị ẩn:', bankCardTable.classList);
          } else {
              console.error('Phản hồi không phải JSON:', data);
              showError('Đã xảy ra lỗi khi lưu thông tin .');
          }
      })
      .catch(error => {
          console.error('Error:', error.message);
          showError('Đã xảy ra lỗi khi lưu .');
      });
  });

  // Xử lý sự kiện khi chọn một tùy chọn ngân hàng
  bankingSuggestions.addEventListener('click', function(event) {
    if (event.target.classList.contains('js-search-select')) {
        const bankName = event.target.getAttribute('data-bank');
        const cardNumber = event.target.getAttribute('data-card');
        const cardHolderName = event.target.getAttribute('data-holder');
        bankingInfoDiv.textContent = `Banking Information: ${bankName}, ***${cardNumber}, ${cardHolderName}`;
    }
  });
});


$(document).on('click', '.btn-remove-from-wishlist', function(e) {
  e.preventDefault(); // Ngừng hành động mặc định của form (submit)

  var form = $(this).closest('form'); // Lấy form chứa button
  var formData = form.serialize(); // Lấy dữ liệu từ form (CSRF token và method DELETE)

  $.ajax({
      url: form.attr('action'), // Lấy URL từ thuộc tính action của form
      type: 'POST', // Dùng POST để gửi yêu cầu, phương thức DELETE sẽ được xác định qua @method('DELETE')
      data: formData, // Dữ liệu gửi đi
      success: function(response) {
          if(response.success) {
              alert(response.message); // Hiển thị thông báo thành công từ server
              location.reload(); // Tải lại trang để cập nhật danh sách wishlist
          } else {
              alert(response.error || 'An error occurred while deleting the product from the wishlist.');
          }
      },
      error: function(xhr, status, error) {
          console.log(xhr.responseText); // In chi tiết lỗi trả về từ server
          alert('An error occurred while deleting the product from the wishlist.');
      }
  });
});


