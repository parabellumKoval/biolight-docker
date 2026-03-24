export const imagePosition = {
	methods: {
		imagePosition(){
			const content = this.$refs?.content

			if (!content || typeof content.querySelectorAll !== 'function') {
				return
			}

			let images = content.querySelectorAll('img');
			
			images.forEach(item => {
				let floatValue = item.style.float;
				
				if(floatValue === 'left') {
					item.style.margin = "0 30px 30px 0";
				}else if(floatValue === 'right'){
					item.style.margin = "0 0 30px 30px";
				}else{
					console.log('NOT FLOAT')
				}
			})
		}
	}
}
