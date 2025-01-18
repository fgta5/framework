window.$fn = {}

window.$fn.SetPageLoaded = () => {
	var pagemask = document.getElementById('fgta5-loading-pagemask')
	pagemask.style.opacity = 0
	pagemask.style.visibility = 'hidden'
	setTimeout(()=>{
		pagemask.parentNode.removeChild(pagemask)
	}, 500);
}


