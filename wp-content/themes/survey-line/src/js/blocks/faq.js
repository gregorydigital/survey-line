export default function initFAQ() { 
    var rows = document.querySelectorAll('.faq-row')
    
    rows.forEach(row => {
        const btn = row.querySelector('.faq-question');
        const panel = row.querySelector('.faq-answer');

        const open = () => {
            panel.hidden = false;                 // make it measurable
            panel.style.height = '0px';           // start height
            // force reflow so the next height change animates
            panel.offsetHeight;                   // 👈 read to flush
            panel.style.height = panel.scrollHeight + 'px';

            const onEnd = (e) => {
            if (e.propertyName !== 'height') return;
                panel.style.height = 'auto';        // let it resize naturally
                panel.removeEventListener('transitionend', onEnd);
            };
            panel.addEventListener('transitionend', onEnd);

            btn.setAttribute('aria-expanded', 'true');
            row.classList.add('active');
        };

        const close = () => {
            // set current pixel height, then animate to 0
            panel.style.height = panel.scrollHeight + 'px';
            panel.offsetHeight;                   // flush
            panel.style.height = '0px';

            const onEnd = (e) => {
            if (e.propertyName !== 'height') return;
                panel.hidden = true;
                panel.removeEventListener('transitionend', onEnd);
            };
            panel.addEventListener('transitionend', onEnd);
            btn.setAttribute('aria-expanded', 'false');
            row.classList.remove('active');
        };

        btn.addEventListener('click', () => {
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            expanded ? close() : open();
        });
    });
}