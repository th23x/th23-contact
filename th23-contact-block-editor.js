wp.blocks.registerBlockType(
	'th23-contact/contact-form',
	{
		category: 'widgets',
		icon: 'email',
		supports: {
			multiple: false,
		},
		edit: function () {
			return wp.element.createElement(
				wp.serverSideRender,
				{
					block: 'th23-contact/contact-form'
				}
			);
		}
	}
);
