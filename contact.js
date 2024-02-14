document.getElementById("prayerForm").addEventListener("submit", function(event) {
    event.preventDefault();
  
    const formData = new FormData(this);
    const prayerRequest = {
      name: formData.get("name"),
      email: formData.get("email"),
      message: formData.get("message")
    };
  
    // Send the prayer request via email or perform any desired action
    console.log(prayerRequest);
    alert("Your prayer request has been submitted. Thank you!");
    this.reset();
  });
  var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}