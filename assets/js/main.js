
const $1 = document.querySelector.bind(document);
const $$1 = document.querySelectorAll.bind(document);


function click_on_category_appear_product() {
    let sliderLists = document.querySelectorAll('.slider.best-selling');
    let categoryItems = document.querySelectorAll('.category-items');
    
    categoryItems.forEach(function(item, index)
    {
        item.onclick = function(events) {
            
            // active appear slider 
            $1('.category-items.active').classList.remove('active');

            events.target.classList.add('active');

            document.querySelector('.slider-active.best-selling').classList.remove('slider-active');
            
            sliderLists[index].classList.add('slider-active');           

            // tạo biến để lấy từng cột danh mục trực tiếp
            const get_product_category = $$1('.best-selling.slider-active .slider-items');
            
            console.log(get_product_category)

            // add animation on products

            get_product_category.forEach(function(productItem)
            {
                productItem.classList.add('play_animation');
                setTimeout(function(){
                    productItem.classList.remove('play_animation');
                }, 1100)
            })

           
        }
    })


}

click_on_category_appear_product();

// active cart

const cart = $1('.nav-cart');
const cart_card = $1('.header__cart-list');

cart.addEventListener('click', function() {
    cart_card.classList.toggle('active');
})

const getMenu = $1('.menu-tab-mb');
const menu = $1('.nav-list');
const overlayMenu = $1('.overlay-menu');


if( getMenu) {

    getMenu.addEventListener('click', function() {
        menu.style.transform = 'translateX(0px)';
        menu.style.display = 'block';
        overlayMenu.style.display = 'block';

    })

    overlayMenu.onclick = function() {
        menu.style.transform = 'translateX(-100%)';
        menu.style.display = 'none';
        overlayMenu.style.display = 'none';
        
    }

    // const subMenuHeight = $1('.nav-item__funiture-list--tab-mob').offsetHeight;

    // $1('.nav-item:first-child').addEventListener('click', function() {
    //     $1('.nav-item__funiture-list--tab-mob').classList.toggle('subMenuHeight');
    // })
}


// active các dot trên hero section
const dotOption = $1('.header-wraper__dot');

dotOption.addEventListener('click', function() {
    $1('.header-wraper__dot-options').classList.toggle('active');
})


const dotOptionVase = $1('.header-wraper__dot--vase');

dotOptionVase.addEventListener('click', function() {
    $1('.product-wrapper__vase').classList.toggle('active');
})

const dotOptionVaseSecon = $1('.header-wraper__dot--vase-secondary');

dotOptionVaseSecon.addEventListener('click', function() {
    $1('.header-wraper__dot-options--vase-secondary ').classList.toggle('active');
})


// chỉnh height cho slider-category
const sliderHeight = $1('.best-selling').offsetHeight;
console.log(sliderHeight)

$1('.best-selling__product').style.height = `${sliderHeight + 60}px`


// set height cho hiệu ứng hover hiện submenu

const subMenuItemHeight = $1('.nav-item__funiture-link').offsetHeight;
const amountItems = $$1('.nav-item__funiture-items').length;

console.log(subMenuItemHeight)

const heightSubMenu = `${(subMenuItemHeight + 10)*amountItems + 10}`

const subMenu = $1('.nav-item:first-child');

subMenu.onclick = function() {
      $1('.nav-item__funiture-list').classList.toggle('active');
}

// $(document).ready(function(){ 
//     console.log(document.querySelector('.slick-arrow'));

// }) 