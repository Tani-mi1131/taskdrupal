<?php
 
namespace Drupal\dummy\Plugin\WebformHandler;
 
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\webform\Plugin\WebformHandlerBase;
use Drupal\webform\WebformSubmissionInterface;
 
/**
 * Create a new node entity from a webform submission.
 *
 * @WebformHandler(
 *   id = "Create a Enity Type",
 *   label = @Translation("Create a Enity Type"),
 *   category = @Translation("Entity Creation"),
 *   description = @Translation("Creates a new node from Webform Submissions."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 *   submission = \Drupal\webform\Plugin\WebformHandlerInterface::SUBMISSION_REQUIRED,
 * )
 */
 
class UploadHandler extends WebformHandlerBase {
  
  /**
   * {@inheritdoc}
   */
 
  // after subitting
  public function postSave(WebformSubmissionInterface $webform_submission, $update = TRUE) {
    $file_field_name = 'mediafiled'; 
    if (!empty($webform_submission->getData($file_field_name))) {
      $file = File::load($webform_submission->getData($file_field_name)['mediafiled']);
      if ($file) {
        
        $file_type = $file->getMimeType();
        if (strpos($file_type, 'video/') === 0) {

        $video_media = Media::create([
          'bundle' => 'video',
          'uid' => 1,
          'name' => $file->getFilename(),
          'field_media_video_file' => [
                'target_id' => $file->id(),
            ],
        ]);
        $video_media->save();
        }
        else if (strpos($file_type, 'image/') === 0) {
          $media = Media::create([
            'bundle' => 'image',
            'name' => $file->getFilename(),
            'field_media_image' => [
                'target_id' => $file->id(),
            ],
        ]);
        $media->save();
        }
        else if ($file_type === 'application/pdf') {
          $media = Media::create([
            'bundle' => 'document',
            'name' => $file->getFilename(),
            'field_media_document' => [
                'target_id' => $file->id(),
            ],
        ]);
        $media->save();
        } else {
            \Drupal::messenger()->addMessage('no Media type found');
        }
      }
    }
  }


}