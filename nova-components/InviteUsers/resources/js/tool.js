Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'invite-users',
      path: '/invite-users',
      component: require('./components/Tool'),
    },
  ])
})
