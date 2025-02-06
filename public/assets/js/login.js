const get = elem => document.getElementById(elem),
					 staffButton = get('staffLogin'),
					 adminButton = get('AdminLogin'),
					 container = get('container')
 
staffButton.onclick = () => {
					 container.className = "active"
}

adminButton.onclick = () => {
						container.className = "close"
}
 

