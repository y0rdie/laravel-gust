export default {
    install (app) {
        let requireContext = require.context('@components', false, /Base\w*\.vue$/)
        requireContext.keys().forEach(filename => {
            let name = filename.replace(/^.*\//, '').replace(/\.\w+$/, '');
            let component = requireContext(filename);

            app.component(
                component.name || name,
                component.default || component,
            );
        });
    },
}
