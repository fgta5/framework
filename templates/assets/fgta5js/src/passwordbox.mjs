import { TextboxElement } from './textbox.mjs'

export default function Fgta5Passwordbox(elid) {
	let self = {
		Type: 'Fgta5Passwordbox'
	}
	
	let el = document.getElementById(elid)
	let baseClass = TextboxElement(self, el)
	let obj = Object.assign(el, baseClass)
	self.Object = obj;

	obj.addDefaultEventListener()


	render(self)
	return obj
}


function render(self) {
}
