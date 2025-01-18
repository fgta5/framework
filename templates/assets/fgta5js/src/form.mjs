export default function Fgta5Form(elid, comps) {
	var self = {}
	
	var el = document.getElementById(elid)
	el.Components = comps;

	return el;
}