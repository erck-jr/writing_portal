<div x-data="{ 
    percent: 0,
    updateProgress() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        this.percent = height > 0 ? (winScroll / height) * 100 : 0;
    }
}" 
x-init="window.addEventListener('scroll', () => updateProgress())"
class="fixed top-0 left-0 w-full h-1 z-[60] pointer-events-none">
    <div class="h-full bg-teal-400 transition-all duration-75" :style="`width: ${percent}%`"></div>
</div>