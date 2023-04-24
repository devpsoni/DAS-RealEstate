function validateForm() {
  // Get input values
  var name = document.getElementById("name").value;
  var password = document.getElementById("password").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  
  // Define regex patterns
  var namePattern = /^[a-zA-Z]{6,}$/;
  var passwordPattern = /^.{6,}$/;
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var phonePattern = /^[0-9]{10}$/;
  
  // Validate name
  if (!namePattern.test(name)) {
    alert("Name should contain alphabets and the length should not be less than 6 characters.");
    return false;
  }
  
  // Validate password
  if (!passwordPattern.test(password)) {
    alert("Password should not be less than 6 characters length.");
    return false;
  }
  
  // Validate email
  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }
  
  // Validate phone
  if (!phonePattern.test(phone)) {
    alert("Phone number should contain 10 digits only.");
    return false;
  }
  
  // If all inputs are valid, return true
  return true;
}
