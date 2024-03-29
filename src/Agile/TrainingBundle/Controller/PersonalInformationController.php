<?php

namespace Agile\TrainingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Agile\TrainingBundle\Entity\PersonalInformation;
use Agile\TrainingBundle\Form\PersonalInformationType;

/**
 * PersonalInformation controller.
 *
 */
class PersonalInformationController extends Controller
{

    /**
     * Lists all PersonalInformation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AgileTrainingBundle:PersonalInformation')->findAll();

        return $this->render('AgileTrainingBundle:PersonalInformation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PersonalInformation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PersonalInformation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personal-information_show', array('id' => $entity->getId())));
        }

        return $this->render('AgileTrainingBundle:PersonalInformation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PersonalInformation entity.
     *
     * @param PersonalInformation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PersonalInformation $entity)
    {
        $form = $this->createForm(new PersonalInformationType(), $entity, array(
            'action' => $this->generateUrl('personal-information_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PersonalInformation entity.
     *
     */
    public function newAction()
    {
        $entity = new PersonalInformation();
        $form   = $this->createCreateForm($entity);

        return $this->render('AgileTrainingBundle:PersonalInformation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PersonalInformation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgileTrainingBundle:PersonalInformation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonalInformation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AgileTrainingBundle:PersonalInformation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PersonalInformation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgileTrainingBundle:PersonalInformation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonalInformation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AgileTrainingBundle:PersonalInformation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PersonalInformation entity.
    *
    * @param PersonalInformation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PersonalInformation $entity)
    {
        $form = $this->createForm(new PersonalInformationType(), $entity, array(
            'action' => $this->generateUrl('personal-information_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PersonalInformation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AgileTrainingBundle:PersonalInformation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PersonalInformation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('personal-information_edit', array('id' => $id)));
        }

        return $this->render('AgileTrainingBundle:PersonalInformation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PersonalInformation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AgileTrainingBundle:PersonalInformation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PersonalInformation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personal-information'));
    }

    /**
     * Creates a form to delete a PersonalInformation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personal-information_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
