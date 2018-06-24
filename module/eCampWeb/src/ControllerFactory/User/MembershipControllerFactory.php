<?php

namespace eCamp\Web\ControllerFactory\User;

use eCamp\Core\EntityService\GroupMembershipService;
use eCamp\Web\Controller\User\MembershipController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class MembershipControllerFactory implements FactoryInterface {
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MembershipController|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        /** @var GroupMembershipService $groupMembershipService */
        $groupMembershipService = $container->get(GroupMembershipService::class);

        return new MembershipController($groupMembershipService);
    }
}
