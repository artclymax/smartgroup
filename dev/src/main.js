//import 'jarallax/dist/jarallax.min.css';
import "@fancyapps/ui/dist/fancybox/fancybox.css";
//import "aos/dist/aos.css";
import './scss/style.scss';
//!
import { Swiper } from "swiper/bundle";

//import { jarallax } from "jarallax";
import { Fancybox } from "@fancyapps/ui/dist/fancybox/";
//import AOS from "AOS";

import { AutoCalc } from "./js/AutoCalc.js";
import { Menu } from './js/Menu.js';
import { RunningLine } from './js/RunningLine.js';
//import { BackdropList } from './js/BackdropList.js';
import { Modal } from './js/Modal.js';
import { cookies } from "./js/Cookies.js";
import { AnimationCounter } from "./js/AnimationCounter.js";
import HiddenDescr from "./js/HiddenDescr.js";
import HiddenList from "./js/HiddenList.js";
import { imask } from "./js/imask.js";
import { fileBtn } from "./js/FileBtn.js";
//import { CustomFieldSelect } from "./js/CustomFieldSelect.js";
//import { Spoiler } from './js/Spoiler.js';
import { ScrollToTop } from './js/ScrollToTop.js';
import { MXSwiper } from './js/MXSwiper.js';
//import { CustomSelect } from './js/CustomSelect.js';
import { Tabs } from './js/Tabs.js';
//import { MapScrollLock } from './js/MapScrollLock.js';
//import { cf7CustomValidation } from './js/cf7-validation.js';
import { SelectFromAcf } from './js/SelectFromAcf.js';
import { loadMore } from './js/loadMore.js';

//cf7CustomValidation();

// FOR CONTACTS FORM 7
//import "./js/redirect-to-thanks-page.js";


new AutoCalc();
//new CustomFieldSelect({
//	input: '.form-wrapper .cf-select',
//	lastEdit: false
//});
new Menu({
	btn: '.burger-btn-icon', //.burger-btn-icon
	menu: '.header-menu',
	activeClass: 'open-header-menu',
	closeBtns: ['.menu-close-btn']
})
//new Menu({
//	btn: '.header__phone-btn', //.burger-btn-icon
//	menu: '.header-phone-box',
//	activeClass: 'open-phone-box',
//	//closeBtns: ['.menu-close-btn']
//})

//new BackdropList();

new Modal();

//jarallax(document.querySelectorAll('.jarallax'), {
//	speed: 0.2,
//});

cookies();
imask();

Fancybox.bind("[data-fancybox]", {
	placeFocusBack: false
});

new RunningLine();
new ScrollToTop();

//new Spoiler();

//new Spoiler('[data-spoiler]', {
//	onlyOneOpen: true,
//	activeClass: 'is-open',
//});

//new Spoiler('.single-team-experience-content', { media: 'max-width: 768px' });

new MXSwiper();
//new Tabs();
//new CustomSelect({
//	selector: 'select',
//	forceSend: true,
//});

//new MapScrollLock();
/*
window.addEventListener('scroll', function () {
	const header = document.querySelector('.header');

	if (window.scrollY > 50) {
		header.classList.add('scrolled');
	} else {
		header.classList.remove('scrolled');
		const valueUnits = header.offsetHeight;
		document.querySelector(':root').style.setProperty(`--header-height`, valueUnits + 'px');
	}
});
*/

fileBtn(document.querySelector('.file-label__text')?.textContent);//

new Tabs();

//document.querySelectorAll('video.wp-video-shortcode').forEach(video => {
//	if (!video.src) {
//		const link = video.querySelector('a');
//		if (link) video.src = link.href;
//	}
//});

document?.querySelectorAll('.wpcf7-acceptance input[type="checkbox"]')?.forEach(el => {
	el.checked = true;
})

//AOS.init({
//	disable: 'mobile',
//	duration: 600,
//});

new SelectFromAcf('.custom-select-product', {
	data: '.select-products-data'
})
loadMore();

//const modalInputBtns = document.querySelectorAll('[data-modal-input-data]');

//if (modalInputBtns.length) {
//	modalInputBtns.forEach(btn => {
//		btn.addEventListener('click', () => {
//			const inputsService = document.querySelectorAll('.form-input-service');
//			const inputsJobs = document.querySelectorAll('.form-input-job');
//			if (inputsService.length) {
//				inputsService.forEach(input => {
//					const modalTitle = input.closest('.modal')?.querySelector('.modal__title');
//					input.value = input.placeholder + ' ' + btn.getAttribute('data-modal-input-data');
//					if (modalTitle) {
//						input.closest('.form-field--hidden').style.display = 'none';
//						modalTitle.textContent = input.value;
//					}
//				})
//			}
//			if (inputsJobs.length) {
//				inputsJobs.forEach(input => {
//					input.value = input.placeholder + ' ' + btn.getAttribute('data-modal-input-data');
//				})
//			}
//		});
//	})
//}

const megaMenuItems = document.querySelectorAll('.mega-menu > .menu-item-has-children');
const megaMenuSubItems = document.querySelectorAll('.mega-menu > .menu-item-has-children > .sub-menu .menu-item-has-children');

// 1. Обработчик для верхнего уровня
if (megaMenuItems.length) {
	megaMenuItems.forEach(item => {
		item.addEventListener('click', (e) => {
			// Закрываем все остальные открытые пункты верхнего уровня
			megaMenuItems.forEach(i => {
				if (i !== item) i.classList.remove('open-submenu');
			});
			// Переключаем текущий
			item.classList.toggle('open-submenu');
		});
	});
}

// 2. Обработчик для вложенного уровня (submenu)
if (megaMenuSubItems.length) {
	megaMenuSubItems.forEach(item => {
		item.addEventListener('click', (e) => {
			// !!! ГЛАВНОЕ ИЗМЕНЕНИЕ !!!
			// Останавливаем всплытие, чтобы клик не дошел до родителя
			e.stopPropagation();

			// Закрываем соседние открытые подменю на этом же уровне
			// (Это лучше, чем закрывать вообще все подменю на странице)
			const siblings = item.parentElement.querySelectorAll(':scope > .menu-item-has-children');
			siblings.forEach(sibling => {
				if (sibling !== item) sibling.classList.remove('open-submenu');
			});

			// Переключаем текущее вложенное меню
			item.classList.toggle('open-submenu');
		});
	});
}
AnimationCounter();
HiddenDescr();
HiddenList();

const productSwiperThumb = new Swiper('.product-hero-swiper-thumb', {
	slidesPerView: 3,
	spaceBetween: 20,
	rewind: true,

})
const productSwiper = new Swiper('.product-hero-swiper', {
	slidesPerView: 1,
	spaceBetween: 20,
	rewind: true,
	navigation: {
		nextEl: '.product-hero-swiper__btn-next',
		prevEl: '.product-hero-swiper__btn-prev',
	},

	thumbs: {
		swiper: productSwiperThumb,
	}
})

const jobsBtn = document.querySelectorAll('[data-jobs-btn]');

if (jobsBtn.length) {
	jobsBtn.forEach(btn => {
		btn.addEventListener('click', () => {
			const inputs = document.querySelectorAll('.form-input-job');

			if (inputs.length) {
				inputs.forEach(input => {
					input.value = btn.getAttribute('data-jobs-btn');
				})
			}
		})
	})
}