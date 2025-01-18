export default function Fgta5Textbox(elid) {
	let self = {
		Type: 'Fgta5Textbox'
	}
	
	
	let el = document.getElementById(elid)
	let baseClass = TextboxElement(self, el)
	let obj = Object.assign(el, baseClass)
	self.Object = obj;

	obj.addDefaultEventListener()

	return obj
}


export function TextboxElement(self, el) {
	return {
		addDefaultEventListener: () => {


			console.log(self)

			// Mencegah aksi default (submit form)
			el.addEventListener('keydown', function(event) {
				if (event.key === 'Enter') {
					event.preventDefault();  
				}
			});

			// event yang lain ?

		}

	}
}