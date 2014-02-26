// Here's 2 functions that expands/toggles all the FAQs.
function toggleallfaqs() {
	$("#faqlist .panel .panel-collapse").collapse("toggle");
}

function openallfaqs() {
	$("#faqlist .panel .panel-collapse").collapse("show");
}

// OnClick event on additem.php and editxml.php
// Just copy the contents in the Ace Editor.
function additemfunc() {
	$("#answer").val(anseditor.getValue());
}

function editxmlfunc() {
	$("#xml").val(xmleditor.getValue());
}