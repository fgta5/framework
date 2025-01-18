import { TextboxElement } from './textbox.mjs'

export default function Fgta5Numberbox(elid) {
	let self = {
		Type: 'Fgta5Numberbox'
	}
	
	let el = document.getElementById(elid)
	let baseClass = TextboxElement(self, el)
	let obj = Object.assign(el, baseClass)
	self.Object = obj;


	obj.addDefaultEventListener()

	return obj
}