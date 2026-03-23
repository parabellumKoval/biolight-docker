<template>
	<div>
		<TheHeader />
		
		<notifications group="header" classes="nt" :duration="5000" :speed="300" animation-name="v-fade-left"	/>
		
		<slot />
		
		<ModalLang :is-visible="$store.state.lang.isShow" />
		
		<ModalContacts :is-visible="$store.state.contacts.isShow" />
		
		<ModalOrder :is-visible="$store.state.order.isShow" />
		
		<TheSocial />
		
		<TheFooterLinks />
		
		<TheFooter />
	</div>
</template>
<style>
	
</style>
