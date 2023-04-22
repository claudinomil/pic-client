import { viteStaticCopy } from 'vite-plugin-static-copy'

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {src: 'resources/assets_template/css/bootstrap.css', dest: 'assets'},
                {src: 'resources/assets_template/css/app.css', dest: 'assets'},
                {src: 'resources/assets_template/css/bootstrap-dark.css', dest: 'assets'},
                {src: 'resources/assets_template/css/app-dark.css', dest: 'assets'},

                {src: 'resources/assets_template/libs/jquery/jquery.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/bootstrap/bootstrap.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/jquery-validation/jquery-validation.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/jquery-validation/jquery-validation-pt-br.js', dest: 'assets'},
                {src: 'resources/assets_template/js/jquery-validation-methods.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/metismenu/metismenu.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/simplebar/simplebar.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/node-waves/node-waves.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/sweetalert2/sweetalert2.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/select2/select2.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/datatables/datatables.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/jszip/jszip.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/pdfmake/pdfmake.min.js', dest: 'assets'},
                {src: 'resources/assets_template/libs/jquery-mask/jquery.mask.min.js', dest: 'assets'},
                {src: 'resources/assets_template/js/jquery-masks.js', dest: 'assets'},
                {src: 'resources/assets_template/js/template.js', dest: 'assets'},
                {src: 'resources/assets_template/js/main.js', dest: 'assets'},

                {src: 'resources/assets_template/js/functions.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_template_init.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_dashboards.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_departamentos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_funcionarios.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_generos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_grupos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_identidade_orgaos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_estados_civis.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_modulos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_nacionalidades.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_naturalidades.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_notificacoes.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_funcoes.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_escolaridades.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_submodulos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_ferramentas.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_tipos_escolas.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_niveis_ensinos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_escolas.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_professores.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_deficiencias.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_alunos.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_users.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_profiles.js', dest: 'assets'},
                {src: 'resources/assets_template/js/scripts_logos.js', dest: 'assets'},

                {src: 'resources/assets_template/images/alunos/aluno-0.png', dest: 'assets/images/alunos'},
                {src: 'resources/assets_template/images/funcionarios/funcionario-0.png', dest: 'assets/images/funcionarios'},
                {src: 'resources/assets_template/images/professores/professor-0.png', dest: 'assets/images/professores'},
                {src: 'resources/assets_template/images/users/avatar-0.png', dest: 'assets/images/users'},
                {src: 'resources/assets_template/images/users/usuarios.jpg', dest: 'assets/images/users'},
                {src: 'resources/assets_template/images/professores/professores.png', dest: 'assets/images/professores'},

                {src: 'resources/assets_template/images/error-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/aluno-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/funcionario-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/professor-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_favicon.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_layout_dark_menu.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_layout_dark_menu_min.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_layout_light_menu.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_layout_light_menu_min.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_login.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_pic.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/image_logo_relatorio.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/megamenu-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/profile-img.png', dest: 'assets/images'},
                {src: 'resources/assets_template/images/welcome_logo.png', dest: 'assets/images'},

                // {src: path.join(__dirname, 'resources/assets_template/images'), dest: path.join(__dirname, '/public')},
            ]
        })
    ]
});


// *** Colocar no manifest.json ***
//
// "resources/assets_template/images/image_favicon.png": {
//     "file": "assets/image_favicon.png",
//     "isEntry": true,
//     "src": "resources/assets_template/images/image_favicon.png"
// },
// "resources/assets_template/libs/jquery/jquery.min.js": {
//     "file": "assets/jquery.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/jquery/jquery.min.js"
// },
// "resources/assets_template/libs/bootstrap/bootstrap.min.js": {
//     "file": "assets/bootstrap.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/bootstrap/bootstrap.min.js"
// },
// "resources/assets_template/libs/jquery-validation/jquery-validation.min.js": {
//     "file": "assets/jquery-validation.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/jquery-validation/jquery-validation.min.js"
// },
// "resources/assets_template/libs/jquery-validation/jquery-validation-pt-br.js": {
//     "file": "assets/jquery-validation-pt-br.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/jquery-validation/jquery-validation-pt-br.js"
// },
// "resources/assets_template/js/jquery-validation-methods.js": {
//     "file": "assets/jquery-validation-methods.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/jquery-validation-methods.js"
// },
// "resources/assets_template/libs/metismenu/metismenu.min.js": {
//     "file": "assets/metismenu.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/metismenu/metismenu.min.js"
// },
// "resources/assets_template/libs/simplebar/simplebar.min.js": {
//     "file": "assets/simplebar.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/simplebar/simplebar.min.js"
// },
// "resources/assets_template/libs/node-waves/node-waves.min.js": {
//     "file": "assets/node-waves.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/node-waves/node-waves.min.js"
// },
// "resources/assets_template/libs/sweetalert2/sweetalert2.min.js": {
//     "file": "assets/sweetalert2.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/sweetalert2/sweetalert2.min.js"
// },
// "resources/assets_template/libs/select2/select2.min.js": {
//     "file": "assets/select2.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/select2/select2.min.js"
// },
// "resources/assets_template/libs/datatables/datatables.min.js": {
//     "file": "assets/datatables.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/datatables/datatables.min.js"
// },
// "resources/assets_template/libs/jszip/jszip.min.js": {
//     "file": "assets/jszip.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/jszip/jszip.min.js"
// },
// "resources/assets_template/libs/pdfmake/pdfmake.min.js": {
//     "file": "assets/pdfmake.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/pdfmake/pdfmake.min.js"
// },
// "resources/assets_template/libs/jquery-mask/jquery.mask.min.js": {
//     "file": "assets/jquery.mask.min.js",
//     "isEntry": true,
//     "src": "resources/assets_template/libs/jquery-mask/jquery.mask.min.js"
// },
// "resources/assets_template/js/jquery-masks.js": {
//     "file": "assets/jquery-masks.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/jquery-masks.js"
// },
// "resources/assets_template/js/template.js": {
//     "file": "assets/template.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/template.js"
// },
// "resources/assets_template/js/main.js": {
//     "file": "assets/main.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/main.js"
// },
// "resources/assets_template/js/functions.js": {
//     "file": "assets/functions.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/functions.js"
// },
// "resources/assets_template/js/scripts_template_init.js": {
//     "file": "assets/scripts_template_init.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_template_init.js"
// },
// "resources/assets_template/js/scripts_dashboards.js": {
//     "file": "assets/scripts_dashboards.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_dashboards.js"
// },
// "resources/assets_template/js/scripts_departamentos.js": {
//     "file": "assets/scripts_departamentos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_departamentos.js"
// },
// "resources/assets_template/js/scripts_funcionarios.js": {
//     "file": "assets/scripts_funcionarios.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_funcionarios.js"
// },
// "resources/assets_template/js/scripts_generos.js": {
//     "file": "assets/scripts_generos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_generos.js"
// },
// "resources/assets_template/js/scripts_grupos.js": {
//     "file": "assets/scripts_grupos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_grupos.js"
// },
// "resources/assets_template/js/scripts_identidade_orgaos.js": {
//     "file": "assets/scripts_identidade_orgaos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_identidade_orgaos.js"
// },
// "resources/assets_template/js/scripts_estados_civis.js": {
//     "file": "assets/scripts_estados_civis.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_estados_civis.js"
// },
// "resources/assets_template/js/scripts_modulos.js": {
//     "file": "assets/scripts_modulos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_modulos.js"
// },
// "resources/assets_template/js/scripts_nacionalidades.js": {
//     "file": "assets/scripts_nacionalidades.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_nacionalidades.js"
// },
// "resources/assets_template/js/scripts_naturalidades.js": {
//     "file": "assets/scripts_naturalidades.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_naturalidades.js"
// },
// "resources/assets_template/js/scripts_notificacoes.js": {
//     "file": "assets/scripts_notificacoes.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_notificacoes.js"
// },
// "resources/assets_template/js/scripts_funcoes.js": {
//     "file": "assets/scripts_funcoes.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_funcoes.js"
// },
// "resources/assets_template/js/scripts_escolaridades.js": {
//     "file": "assets/scripts_escolaridades.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_escolaridades.js"
// },
// "resources/assets_template/js/scripts_submodulos.js": {
//     "file": "assets/scripts_submodulos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_submodulos.js"
// },
// "resources/assets_template/js/scripts_ferramentas.js": {
//     "file": "assets/scripts_ferramentas.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_ferramentas.js"
// },
// "resources/assets_template/js/scripts_users.js": {
//     "file": "assets/scripts_users.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_users.js"
// },
// "resources/assets_template/js/scripts_tipos_escolas.js": {
//     "file": "assets/scripts_tipos_escolas.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_tipos_escolas.js"
// },
// "resources/assets_template/js/scripts_niveis_ensinos.js": {
//     "file": "assets/scripts_niveis_ensinos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_niveis_ensinos.js"
// },
// "resources/assets_template/js/scripts_escolas.js": {
//     "file": "assets/scripts_escolas.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_escolas.js"
// },
// "resources/assets_template/js/scripts_professores.js": {
//     "file": "assets/scripts_professores.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_professores.js"
// },
// "resources/assets_template/js/scripts_deficiencias.js": {
//     "file": "assets/scripts_deficiencias.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_deficiencias.js"
// },
// "resources/assets_template/js/scripts_alunos.js": {
//     "file": "assets/scripts_alunos.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_alunos.js"
// },
// "resources/assets_template/js/scripts_profiles.js": {
//     "file": "assets/scripts_profiles.js",
//     "isEntry": true,
//     "src": "resources/assets_template/js/scripts_profiles.js"
// },
// "resources/assets_template/js/scripts_logos.js": {
//     "file": "assets/scripts_logos.js",
//         "isEntry": true,
//         "src": "resources/assets_template/js/scripts_logos.js"
// }
