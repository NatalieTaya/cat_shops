// Вешаем обработчик на document (или ближайшего статичного родителя)
document.getElementById('qproducts').addEventListener('click', function(event) {
    // Проверяем, был ли клик по элементу с классом 'product' или его потомку
    const productCard = event.target.closest('.product');
    
    if (productCard) {
        // Нашли карточку товара - вызываем нашу функцию
        showProductDetails(productCard)
    }
});




function showProductDetails(productElement) {
    // Получаем данные из карточки товара
    const productName = productElement.querySelector('.product_name').textContent;
    const productImage = productElement.querySelector('.product_image').innerHTML;
    const productCost = productElement.querySelector('.product_cost').textContent;
    
    // Заполняем модальное окно
    document.getElementById('modal-product-name').textContent = productName;
    document.getElementById('modal-product-image').innerHTML = productImage;
    document.getElementById('modal-product-cost').textContent = productCost;
    
    // Показываем модальное окно
    document.getElementById('product-modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('product-modal').style.display = 'none';
}

// Закрытие модального окна при клике вне его
window.onclick = function(event) {
    const modal = document.getElementById('product-modal');
    if (event.target === modal) {
        closeModal();
    }
}