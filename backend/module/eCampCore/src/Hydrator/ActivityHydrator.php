<?php

namespace eCamp\Core\Hydrator;

use eCamp\Core\Entity\Activity;
use eCamp\Core\Entity\ActivityResponsible;
use eCamp\Lib\Entity\EntityLink;
use eCamp\Lib\Entity\EntityLinkCollection;
use eCamp\Lib\Hydrator\Util;
use eCampApi\V1\Rest\CampCollaboration\CampCollaborationCollection;
use eCampApi\V1\Rest\ScheduleEntry\ScheduleEntryCollection;
use Laminas\Hydrator\HydratorInterface;

class ActivityHydrator implements HydratorInterface {
    public static function HydrateInfo() {
        return [
            'activityCategory' => Util::Entity(function (Activity $e) {
                return $e->getActivityCategory();
            }),
            'campCollaborations' => Util::Collection(function (Activity $e) {
                return new CampCollaborationCollection(
                    $e->getActivityResponsibles()->map(function (ActivityResponsible $ar) {
                        return $ar->getCampCollaboration();
                    })
                );
            }, null),
            'scheduleEntries' => Util::Collection(function (Activity $e) {
                return new ScheduleEntryCollection($e->getScheduleEntries());
            }, null),
        ];
    }

    /**
     * @param object $object
     *
     * @return array
     */
    public function extract($object) {
        /** @var Activity $activity */
        $activity = $object;

        return [
            'id' => $activity->getId(),
            'title' => $activity->getTitle(),
            'location' => $activity->getLocation(),

            'camp' => new EntityLink($activity->getCamp()),
            'activityCategory' => EntityLink::Create($activity->getActivityCategory()),

            'campCollaborations' => new EntityLinkCollection(new CampCollaborationCollection(
                $activity->getActivityResponsibles()->map(function (ActivityResponsible $ar) {
                    return $ar->getCampCollaboration();
                })
            )),

            'scheduleEntries' => new EntityLinkCollection($activity->getScheduleEntries()),

            'activityContents' => new EntityLinkCollection($activity->getActivityContents()),

            //            'activityContents' => Link::factory([
            //                'rel' => 'activityContents',
            //                'route' => [
            //                    'name' => 'e-camp-api.rest.doctrine.activity-content',
            //                    'options' => [ 'query' => [ 'activityId' => $activity->getId() ] ]
            //                ]
            //            ]),
        ];
    }

    /**
     * @param object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object) {
        /** @var Activity $activity */
        $activity = $object;

        if (isset($data['title'])) {
            $activity->setTitle($data['title']);
        }
        if (isset($data['location'])) {
            $activity->setLocation($data['location']);
        }

        return $activity;
    }
}
