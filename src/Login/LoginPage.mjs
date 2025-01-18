/* LoginPage.mjs */

const form = $fgta5.Form('form', {
	user_id: $fgta5.Textbox('obj_txt_user_id'),
	user_password: $fgta5.Passwordbox('obj_txt_user_password'),
});

const btn_login = $fgta5.Button('btn_login')


export async function main(args) {
	console.log('main function of LoginPage.mjs called')

	btn_login.addEventListener('click', ()=>{
		btn_login_click()
	});

}


function btn_login_click() {
	console.log('login click')
}