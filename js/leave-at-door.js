function revealDeliveryInstructions() {
	// Get the checkbox
	var checkBox = document.getElementById("leave_at_door_checkbox");
	// Get the output text
	var text = document.getElementById("leave_at_door_instructions_field");

	// If the checkbox is checked, display the output text
	if (checkBox.checked == true) {
		text.style.display = "block";
	} else {
		text.style.display = "none";
	}
}
