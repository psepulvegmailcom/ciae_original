---[find]---
		for (i=0;i<arr.length;i++) {
---[replace]---
		arr[arr.length] = 'file';
		for (i=0;i<arr.length;i++) {
---[find]---
		hD(gE('vmore'));
---[replace]---
		hD(gE('vmore'));
		hD(gE('vfedit'));
---[find]---
		hD(gE('vedit'));
---[replace]---
		hD(gE('vedit'));
		hD(gE('vfedit'));
---[find]---
function freak_body_submit() {
---[replace]---
function freak_file_add() {
	freak_start();
	sD(gE('vfedit'));
	hD(gE('vmore'));
}
function freak_file_download(id) {
	freak_start();
	xajax_task_file_download(id);
}
function freak_file_delete(id) {
	freak_start();
	xajax_task_file_delete(id);
}
function freak_body_submit() {