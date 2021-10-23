class AutomateSlider{
    constructor(elementToShow, classActive) {
        this.slideIndex = 1;
        this.elementToShow = document.getElementsByClassName(elementToShow);
        this.classActive = classActive;
        this.imagesCount = this.elementToShow[0].childElementCount;
        this.activeSlide();
    }

    activeSlide() {
        this.elementToShow[0].childNodes[this.slideIndex].classList.add(this.classActive);
        this.changeSlide();
    }
    deActiveSlide() {
        this.elementToShow[0].childNodes[this.slideIndex].classList.remove(this.classActive);
    }

    changeSlide() {
        let that = this;
        setTimeout(function(){
            that.deActiveSlide();
            that.slideIndex = that.slideIndex + 2;
            if (that.slideIndex > (that.imagesCount * 2)) {
                that.slideIndex = 1;
            }
            that.activeSlide();
        }, 2500);
    }
}
