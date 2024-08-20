function validateForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const contact = document.getElementById("contact").value;

    if (name === "" || email === "" || contact === "") {
        alert("All fields must be filled out!");
        return false;
    }

    const phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(contact)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    return true;
}
