import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import {get, post} from "./http.js";

Alpine.plugin(collapse)

window.Alpine = Alpine;

document.addEventListener("alpine:init", async () => {

  Alpine.data("toast", () => ({
    visible: false,
    delay: 5000,
    percent: 0,
    interval: null,
    timeout: null,
    message: null,
    close() {
      this.visible = false;
      clearInterval(this.interval);
    },
    show(message) {
      this.visible = true;
      this.message = message;

      if (this.interval) {
        clearInterval(this.interval);
        this.interval = null;
      }
      if (this.timeout) {
        clearTimeout(this.timeout);
        this.timeout = null;
      }

      this.timeout = setTimeout(() => {
        this.visible = false;
        this.timeout = null;
      }, this.delay);
      const startDate = Date.now();
      const futureDate = Date.now() + this.delay;
      this.interval = setInterval(() => {
        const date = Date.now();
        this.percent = ((date - startDate) * 100) / (futureDate - startDate);
        if (this.percent >= 100) {
          clearInterval(this.interval);
          this.interval = null;
        }
      }, 30);
    },
  }));

  Alpine.data("productItem", (product) => {
    return {
      product,
      addToCart(quantity = 1) {
        post(this.product.addToCartUrl, { quantity })
          .then((result) => {
            this.$dispatch("cart-change", { count: result.count });
            this.$dispatch("notify", {
                message: "The item was added into the basket",
            });
          })
          .catch((response) => {
            console.log(response);
            console.log(this.product);
          });
      },
      removeItemFromCart() {
        post(this.product.removeUrl)
          .then(result => {
            this.$dispatch("notify", {
              message: "The item was removed from the basket",
            });
            this.$dispatch('cart-change', {count: result.count})
            this.cartItems = this.cartItems.filter(p => p.id !== product.id)
          })
      },
      changeQuantity() {
        post(this.product.updateQuantityUrl, {quantity: product.quantity})
          .then(result => {
            this.$dispatch('cart-change', {count: result.count})
            this.$dispatch("notify", {
              message: "The item quantity was updated",
            });
          })
      },
    };
  });
});

Alpine.start();


// Modal
const activeImage = document.querySelector("#activeImage");
const productCaption = document.querySelector('#productCaption');

const modal = document.getElementById("Modal");
const modalImg = document.querySelector('#ModalImg');
const modalCaption = document.querySelector('#modalCaption');

const image = document.querySelector("#activeImage img");
const body = document.querySelector("body");
let closeIcon = document.getElementsByClassName("close")[0]; // close icon

if (activeImage) {
    activeImage.onclick = () => {
    modal.style.display = "block";
    modalImg.src = image.src;
    modalCaption.innerText = productCaption.innerText;
    localStorage.setItem('modal', 'active');
    addModalActiveStyles()
  };
}

closeIcon.onclick = () => {
  removeModalActiveStyles();
};

modal.onclick = () => {
  removeModalActiveStyles();
};

window.onresize = () => {
  removeModalActiveStyles();
}

function addModalActiveStyles() {
    if (localStorage.getItem('modal') === 'active') {
        body.style.overflow = "hidden";
    }
}

function removeModalActiveStyles() {
    if (localStorage.getItem('modal') === 'active') {
        localStorage.setItem('modal', '')
        modal.style.display = "none";
        body.style.overflow = "auto";
    }
}