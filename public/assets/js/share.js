class ShareButton extends DetailsDisclosure {
  constructor() {
    super();

    this.elements = {
      shareButton: this.querySelector('button'),
      successMessage: this.querySelector('[id^="ShareMessage"]'),
      urlInput: this.querySelector('input')
    }
    if (navigator.share) {
      this.mainDetailsToggle.setAttribute('hidden', '');
      this.elements.shareButton.classList.remove('hidden');
      this.elements.shareButton.addEventListener('click', () => { navigator.share({ url: document.location.href, title: document.title }) });
    } else {
      this.mainDetailsToggle.addEventListener('toggle', this.toggleDetails.bind(this));
      this.mainDetailsToggle.querySelector('button').addEventListener('click', this.copyToClipboard.bind(this));
    }
  }

  toggleDetails() {
    if (!this.mainDetailsToggle.open)
      this.elements.successMessage.classList.add('hidden');
  }

  copyToClipboard() {
    navigator.clipboard.writeText(this.elements.urlInput.value).then(() => {
      this.elements.successMessage.classList.remove('hidden');
      this.elements.successMessage.setAttribute('aria-hidden', false);

      setTimeout(() => {
        this.elements.successMessage.setAttribute('aria-hidden', true);
      }, 6000);
    });
  }
}

customElements.define('share-button', ShareButton);


document.getElementById('review-form').addEventListener('submit', function(event) {
    var rating = document.getElementById('form-input-rating').value;
    var comment = document.getElementById('form-input-review').value.trim();

    // Kiểm tra xem rating có được chọn và comment có được nhập không
    if (!rating || !comment) {
        event.preventDefault(); // Ngừng gửi form
        document.getElementById('error-message-review').style.display = 'block'; // Hiển thị thông báo lỗi
    }
});

const imagesInput = document.getElementById('imagesInput');
const errorMessageImages = document.getElementById('error-message-images');

imagesInput.addEventListener('change', function() {
    if (this.files.length > 4) {
        errorMessageImages.style.display = 'block';
        this.value = ''; // Xóa file đã chọn
    } else {
        errorMessageImages.style.display = 'none';
    }
});
