<?php

namespace EcampCore\Controller;

use EcampCore\Entity\Medium;

abstract class AbstractBaseController extends \EcampLib\Controller\AbstractBaseController
{

    /**
     * @return \EcampCore\Service\UserService
     */
    protected function getUserService()
    {
        return $this->getServiceLocator()->get('EcampCore\Service\User');
    }

    /**
     * @return \EcampCore\Service\CampService
     */
    protected function getCampService()
    {
        return $this->getServiceLocator()->get('EcampCore\Service\Camp');
    }

    /**
     * @return \EcampCore\Service\GroupService
     */
    protected function getGroupService()
    {
        return $this->getServiceLocator()->get('EcampCore\Service\Group');
    }

    /**
     * @return \EcampCore\Entity\User
     */
    protected function getMe()
    {
       return $this->getUserService()->Get();
    }

    /**
     * @return \EcampCore\Entity\User
     */
    protected function getRouteUser()
    {
        $userId = $this->params('user');

        return $this->getUserService()->Get($userId);
    }

    /**
     * @return \EcampCore\Entity\Group
     */
    protected function getRouteGroup()
    {
        $groupId = $this->params('group');

        return $this->getGroupService()->Get($groupId);
    }

    /**
     * @return \EcampCore\Entity\Camp
     */
    protected function getRouteCamp()
    {
        $campId = $this->params('camp');

        return $this->getCampService()->Get($campId);
    }

    /**
     * @return \EcampCore\Entity\Medium
     */
    protected function getWebMedium()
    {
        $mediumRepository = $this->getServiceLocator()->get('EcampCore\Repository\Medium');

        return $mediumRepository->find(Medium::MEDIUM_WEB);
    }

    /**
     * @return \EcampCore\Entity\Medium
     */
    protected function getPrintMedium()
    {
        $mediumRepository = $this->getServiceLocator()->get('EcampCore\Repository\Medium');

        return $mediumRepository->find(Medium::MEDIUM_PRINT);
    }
}