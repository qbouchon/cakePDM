class e{picker;options;priority=0;dependencies=[];attach(e){const t=this.getName(),s={...this.options};this.options={...this.options,...e.options[t]||{}};for(const i of Object.keys(s))if(null!==s[i]&&"object"==typeof s[i]&&Object.keys(s[i]).length&&t in e.options&&i in e.options[t]){const n={...e.options[t][i]};null!==n&&"object"==typeof n&&Object.keys(n).length&&Object.keys(n).every((e=>Object.keys(s[i]).includes(e)))&&(this.options[i]={...s[i],...n})}if(this.picker=e,this.dependenciesNotFound()){const e=this.dependencies.filter((e=>!this.pluginsAsStringArray().includes(e)));return void console.warn(`${this.getName()}: required dependencies (${e.join(", ")}).`)}const i=this.camelCaseToKebab(this.getName());this.picker.ui.container.classList.add(i),this.onAttach()}detach(){const e=this.camelCaseToKebab(this.getName());this.picker.ui.container.classList.remove(e),"function"==typeof this.onDetach&&this.onDetach()}dependenciesNotFound(){return this.dependencies.length&&!this.dependencies.every((e=>this.pluginsAsStringArray().includes(e)))}pluginsAsStringArray(){return this.picker.options.plugins.map((e=>"function"==typeof e?(new e).getName():e))}camelCaseToKebab(e){return e.replace(/([a-zA-Z])(?=[A-Z])/g,"$1-").toLowerCase()}}export{e as BasePlugin};