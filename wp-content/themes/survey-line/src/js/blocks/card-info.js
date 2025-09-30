export default function initCardInfo() { 

    var containers = document.querySelectorAll('.card-info-split');
    var mobileDetails = document.querySelector('.card-info-split__details')
    var mobileClose = document.querySelector('#mobile-team-bio-close')

    containers.forEach(container => {

        var allCards = container.querySelectorAll('.user-card');

        allCards.forEach(card => {
            card.addEventListener('click', function (e) {

                mobileDetails.classList.add('active')
                const allBios = container.querySelectorAll('article');
                const isOpen = card.classList.contains('active');

                if (!isOpen) {
                    allCards.forEach(b => b.classList.remove('active'));
                    allCards.forEach(b => b.classList.add('unactive'));
                    card.classList.remove('unactive');
                    card.classList.add('active');
                    var id = card.id;
                    var selectedBio = document.getElementById(`bio-${id}`);
                    allBios.forEach(b => b.style.display = 'none');
                    selectedBio.style.display = 'flex';
                }

                if (window.innerWidth < 520) {
                    document.documentElement.classList.add("mobile-no-scroll");
                }
            });
        });

        mobileClose.addEventListener('click', function (e){
            mobileDetails.classList.remove('active');
            document.documentElement.classList.remove("mobile-no-scroll");
        });
    });

    
}