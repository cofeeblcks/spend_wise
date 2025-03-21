<div x-data="{
    secuence: 0,
    messages: [],
    deleteMessage: function(id) {
        this.messages = this.messages.filter(function(message) {
            return message.id != id;
        });
    },
    addMessage: function(message) {
        this.messages.push({
            id: this.secuence++,
            title: message.title,
            message: message.message,
            type: message.type,
            duration: message.duration,
            timmer: null,
            show: true
        });
    },
    init() {
        Livewire.on('add-notification', (message) => {
            this.addMessage(message[0]);
        });
    }
}">
    <div x-show="messages.length > 0" class="fixed top-0 right-4 w-[400px] max-h-screen overflow-y-auto z-[9999999999999] overflow-x-hidden">
        <div class="px-5 pt-6 pb-8 w-full">
            <template x-for="message in messages" :key="message.id">
                <div class="pt-2 animate-right-entrance" x-init="message.timmer = setTimeout(() => {
                    message.show = false;
                    setTimeout(() => { deleteMessage(message.id); }, 500);
                }, message.duration)" x-show="message.show" x-transition:out.opacity.duration.500ms
                    x-transition:leave.opacity.duration.500ms>

                    <div :class="'flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md' + (
                        message.type == 'success' ? ' text-success' :
                        message.type == 'info' ? ' text-info' :
                        message.type == 'warning' ? ' text-warning' :
                        message.type == 'danger' ? ' text-danger' : ''
                    )">
                        <div class="bg-white rounded-full size-8 absolute top-6 right-2 cursor-pointer" x-on:click="deleteMessage(message.id);clearTimeout(message.timmer);message.show = false;">
                            <span class="sr-only">Close</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex w-full max-w-sm overflow-hidden">
                            <div x-show="message.type == 'success'">
                                <div class="flex items-center justify-center w-12 h-full bg-success">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                                    </svg>
                                </div>
                            </div>
                            <div x-show="message.type == 'danger'">
                                <div class="flex items-center justify-center w-12 h-full bg-danger">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                                    </svg>
                                </div>
                            </div>
                            <div x-show="message.type == 'warning'">
                                <div class="flex items-center justify-center w-12 h-full bg-warning">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                                    </svg>
                                </div>
                            </div>
                            <div x-show="message.type == 'info'">
                                <div class="flex items-center justify-center w-12 h-full bg-info">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span :class="'font-semibold ' + (
                                        message.type == 'success' ? ' text-success' :
                                        message.type == 'danger' ? ' text-danger' :
                                        message.type == 'warning' ? ' text-warning' :
                                        message.type == 'info' ? ' text-info' : ''
                                    )" x-text="message.title"></span>
                                    <p class="text-sm text-gray-600" x-html="message.message"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
