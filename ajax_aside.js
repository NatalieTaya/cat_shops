const label=document.getElementById("label_cost")
const qproducts = document.getElementById('qproducts');
const slider = document.getElementById("cost")
const form = document.getElementById("form_extended_search")
const checkboxesColors = document.querySelectorAll('input[type="checkbox"][name="colors"]');
const checkboxesCategories = document.querySelectorAll('input[type="checkbox"][name="categories"]');

// Настройки пагинации
const itemsPerPage = 8; // Товаров на странице
let totalAmountofPages;
let currentPage = 1;    // Текущая страница
let startIndex = (currentPage - 1) * itemsPerPage;
let endIndex = startIndex + itemsPerPage;

// задержка выполнения
let timeout;
//загрузка товаров при обновлении страницы
window.onload = function() {
    loadData(currentPage)
}
function loadData(page){
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const value =slider.value
        label.textContent=value+"$"

        // Создаем FormData для  отправки
        const formData = new FormData();
        formData.append('slider_value', value);
        formData.append('products_data', JSON.stringify(products));


        // Добавляем обработчик к каждому чекбоксу Colors
        const id_colors = [];;
        const checked_colors= [];
        checkboxesColors.forEach(checkbox => {
            id_colors.push(checkbox.getAttribute('color_id'));
            checked_colors.push(checkbox.checked ? '1' : '0');
        });
        formData.append('id_colors', id_colors);
        formData.append('checked_colors', checked_colors);

        // Добавляем обработчик к каждому чекбоксу Categories
        const id_categories = [];;
        const checked_categories= [];
        checkboxesCategories.forEach(checkbox => {
            id_categories.push(checkbox.getAttribute('categorie_id'));
            checked_categories.push(checkbox.checked ? '1' : '0');
        });
        formData.append('id_categories', id_categories);
        formData.append('checked_categories', checked_categories);

        // Отправляем AJAX-запрос
        const xhr = new XMLHttpRequest(); // Создаём объект XMLHttpRequest (XHR) для отправки запросов на сервер
        xhr.open('POST', 'process.php', true); // 'POST' - метод HTTP-запроса
                                               // 'process.php' - URL серверного скрипта, который будет обрабатывать запрос
                                               // true - запрос асинхронный (не блокирует выполнение скрипта)
        xhr.onload = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                displayProducts(xhr.responseText);
                renderPagination(page);
            }
        };
        
        xhr.send(formData); 
    }, 500); // Задержка 300 мс
}
// загрузка товаров при взаимодействии с панелью Расширенный поиск
form.addEventListener('input', function() {
    loadData(currentPage)
});



// Отображение товаров в соответствии с пагинацией
function displayProducts(responseText) {
    qproducts.innerHTML = '';
    const response = JSON.parse(responseText);
    // подсчитываем, сколько страниц пагинаци нужно на найденное количество товаров
    totalAmountofPages=Math.ceil(response.length / itemsPerPage);
    // показать только  itemsPerPage товаров
    productsToShow = response.slice(startIndex, endIndex);

    productsToShow.forEach(product => {
        qproducts.innerHTML += `
            <div class="product">
                <h2 class="product_name">${product.name}</h2>
                <div class="product_image"><img src="${product.picture}" alt=""></div>
                <div class="product_cost">${product.cost}$</div> 
            </div>
        `;
    });
}
// Отображение пагинации
function renderPagination(page) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
    // рисуем кнопки номеров страниц пагинации
    for(i=1;i<totalAmountofPages+1;i++) {
    pagination.innerHTML += `
                <button class="pagination_btn" onclick="changeCurrentPage(${i})">
                ${i}
                </button>
                `
    }
}
// Отображение пагинации
function changeCurrentPage(page) {
    currentPage = page
    startIndex = (currentPage - 1) * itemsPerPage;
    endIndex = startIndex + itemsPerPage;
    loadData(currentPage)
}
