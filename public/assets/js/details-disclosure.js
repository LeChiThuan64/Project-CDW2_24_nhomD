class DetailsDisclosure extends HTMLElement {
  constructor() {
    super();
    this.mainDetailsToggle = this.querySelector('details');

    this.addEventListener('keyup', this.onKeyUp);
    this.mainDetailsToggle.addEventListener('focusout', this.onFocusOut.bind(this));
  }

  onKeyUp(event) {
    if(event.code.toUpperCase() !== 'ESCAPE') return;

    const openDetailsElement = event.target.closest('details[open]');
    if (!openDetailsElement) return;

    const summaryElement = openDetailsElement.querySelector('summary');
    openDetailsElement.removeAttribute('open');
    summaryElement.focus();
  }

  onFocusOut() {
    setTimeout(() => {
      if (!this.contains(document.activeElement)) this.close();
    })
  }

  close() {
    this.mainDetailsToggle.removeAttribute('open')
  }
}

customElements.define('details-disclosure', DetailsDisclosure);

document.querySelectorAll('.js-add-wishlist, .add-to-wishlist').forEach(button => {
  button.addEventListener('click', function (event) {
      event.preventDefault(); // Ngăn việc chuyển hướng trang
      const productId = this.getAttribute('data-product-id');

      // Kiểm tra nếu productId hợp lệ
      if (!productId) {
          return;
      }

      // Gọi API toggle
      fetch(`/wishlist/toggle/${productId}`, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
      })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert(data.message); // Hiển thị thông báo
                  this.classList.toggle('wishlist-added'); // Thay đổi trạng thái nút
              } else {
                  alert(data.message); // Hiển thị lỗi
              }
          })
          .catch(error => {
              console.error('Error:', error);
          });
  });
});
