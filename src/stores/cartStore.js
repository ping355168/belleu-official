import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: JSON.parse(localStorage.getItem('cart') || '[]')
    }),
    getters: {
        itemCount: (state) =>
            state.items.reduce((sum, item) => sum + (parseInt(item.quantity) || 0), 0)
          
    },
    actions: {
        addItem(product) {
            this.items.push({
              ...product,
              quantity: 1,
              selectedSize: product.selectedSize || '',
              selectedColor: product.selectedColor || ''
            })
            this.save()
          },
        save() {
            localStorage.setItem('cart', JSON.stringify(this.items))
        },
        load() {
            this.items = JSON.parse(localStorage.getItem('cart') || '[]')
        },
        clear() {
            this.items = []
            this.save()
        },
        removeItem(index) {
            this.items.splice(index, 1)
            this.save()
        }
    }
})
