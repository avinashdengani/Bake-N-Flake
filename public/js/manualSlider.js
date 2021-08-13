class ManualSlider{
    constructor(elementToShowClassName, classActive, btnNext, btnPrev) {
        this.slideIndex = 1;
        this.elementToShowClassName = elementToShowClassName;
        this.elementToShow = document.getElementsByClassName(elementToShowClassName);
        this.imagesCount = this.elementToShow[0].childElementCount;
        this.classActive = classActive;
        this.btnNext= document.getElementsByClassName(btnNext);
        this.btnPrev = document.getElementsByClassName(btnPrev);
        this.events();
        this.activeSlide();
    }

    events() {
      const that = this;
      for(let i=0; i<this.btnNext.length; i++) {
        this.btnNext[i].addEventListener("click" , function() {
            that.deActiveSlide();
            that.slideIndex = that.slideIndex +2;
            that.ValidateSlideIndex();
          });
      }
      for(let i=0; i<this.btnPrev.length; i++) {
        this.btnPrev[i].addEventListener("click" , function() {
            that.deActiveSlide();
            that.slideIndex = that.slideIndex - 2;
            that.ValidateSlideIndex();
          });
      }
  }
  deActiveSlide() {
    this.elementToShow[0].childNodes[this.slideIndex].classList.remove(this.classActive);
  }
  ValidateSlideIndex() {
    if (this.slideIndex > (this.imagesCount * 2)) {
      this.slideIndex = 1;
    }

    if (this.slideIndex < 1) {
      this.slideIndex = (this.imagesCount * 2) - 1;
    }
    this.activeSlide();
  }
  activeSlide() {
    this.elementToShow[0].childNodes[this.slideIndex].classList.add(this.classActive);
  }
}
