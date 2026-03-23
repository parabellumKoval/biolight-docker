<template>
	<div class="contacts">
		<div class="contacts__title">{{ $t('title.glad_to_support') }}</div>
		<div class="contacts__inner">
			
			<div class="contacts__item">
				<div class="contacts__item-title">
					<span class="icon icon-phone-ring"></span>
					{{ $t('title.call_us') }}
				</div>
				<div class="contacts__item-value">
					<div>
						<a :href="'tel:' + $store.state.settings.phone" class="underline">{{ $store.state.settings.phone }}</a>
					</div>
					<div>
						<a :href="'tel:' + $store.state.settings.phone_2" class="underline">{{ $store.state.settings.phone_2 }}</a>
					</div>
				</div>
			</div>

			<div class="contacts__item">
				<div class="contacts__item-title">
					<span class="icon icon-mail-reply"></span>
					{{ $t('title.mail_us') }}
				</div>
				<div class="contacts__item-value">
					<a :href="'mailto:' + $store.state.settings.email" class="underline">
						{{ $store.state.settings.email }}
					</a>
				</div>
			</div>

			<div class="contacts__item">
				<ul class="socials">
		        <li class="socials__item">
		          <nuxt-picture src="/assets/images/socials/tel.png" alt="Telegram" width="24" height="24" sizes="24px" quality="80" format="webp" />
		
		          <a :href="$store.state.settings.telegram">
		            <span class="underline">Мы в Telegram</span>
		          </a>
		        </li>
		
		        <li class="socials__item">
		          <nuxt-picture src="/assets/images/socials/viber.png" alt="Viber" width="24" height="24" sizes="24px" quality="80" format="webp" />
		
		          <a :href="$store.state.settings.viber">
		            <span class="underline">Мы в Viber</span>
		          </a>
		        </li>
		
		        <li class="socials__item">
		          <nuxt-picture src="/assets/images/socials/wat.png" alt="WhatsApp" width="24" height="24" sizes="24px" quality="80" format="webp" />
		
		          <a :href="$store.state.settings.whatsup">
		            <span class="underline">Мы в Whatsup</span>
		          </a>
		        </li>
	      </ul>
			</div>			
						
		</div>
		
		<div class="contacts-bg">
			<nuxt-picture src="/assets/images/bio-bg.jpg" sizes="sm:150px lg:452px" quality="80" format="webp" />
		</div>
		<div class="contacts-img">
			<nuxt-picture src="/assets/images/manager.png" sizes="sm:150px lg:316px" quality="100" format="webp" />
		</div>
		
	</div>
</template>

<style lang='scss' src='@/assets/scss/components/base-contacts.scss' scoped></style>
