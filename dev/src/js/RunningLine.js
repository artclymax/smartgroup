export class RunningLine {
	constructor(selector, options) {
		const defaultOptions = {
			listSelector: '[data-running-line-list]',
			quantity: false,
		}

		this.selector = selector || '[data-running-line]';
		this.options = Object.assign(defaultOptions, options);
		this.elements = document.querySelectorAll(this.selector);
		this.init();
	}

	copyItem(item, parent) {
		const copiedItem = item.cloneNode(true);
		copiedItem.setAttribute('aria-hidden', true);
		parent.insertAdjacentElement("beforeend", copiedItem);
	}

	// Новый метод для установки точного смещения
	setAnimationOffset(list) {
		const gap = parseInt(getComputedStyle(list).gap) || 0;
		const halfWidth = list.scrollWidth / 2;
		const offset = halfWidth + (gap / 2);

		// Устанавливаем CSS-переменную для точного смещения
		list.style.setProperty('--running-line-offset', `-${offset}px`);
	}

	init() {
		if (!this.elements.length) {
			console.warn(`[RunningLine]: Selector '${this.selector}' is not found!`);
			return;
		}
		const { listSelector, quantity } = this.options;

		this.elements.forEach(element => {
			const list = element.querySelector(listSelector) || element.children[0];
			const children = Array.from(list.children);

			if (quantity) {
				for (let i = 0; i < quantity; i++) {
					this.copyItem(children[0], list)
				}
			} else {
				children.forEach((item) => {
					this.copyItem(item, list)
				})
			}

			// Вычисляем и устанавливаем точное смещение
			this.setAnimationOffset(list);
		})
	}
}