// import { jsPDF } from "jspdf";

// Default export is a4 paper, portrait, using millimeters for units
function PayslipPDF(){
	var element = document.getElementById('element-to-print');
	var opt = {
		margin:       1,
		filename:     'Payslip.pdf',
		image:        { type: 'jpeg', quality: 0.98 },
		html2canvas:  { scale: 2 },
		jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
	};

// New Promise-based usage:
	html2pdf().set(opt).from(element).save();

// Old monolithic-style usage:
	html2pdf(element, opt);
}
