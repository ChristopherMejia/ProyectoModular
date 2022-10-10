<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Phpml\Metric\Accuracy;
use Phpml\Dataset\CsvDataset;
use Phpml\Classification\SVC;
use Phpml\Dataset\ArrayDataset;
use Phpml\Tokenization\WordTokenizer;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Classification\MLPClassifier;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\FeatureExtraction\TokenCountVectorizer;

class MultilayerPerceptron extends Controller
{
    public function perceptron()
    {
        /**
         * helper to load data from CSV file.
         * (int) number of columns that are features
         * (bool) define is file have a heading row
         */
        $dataset = new CsvDataset('dataset/questions.csv', 1);

        /**
         * Transform a collection of text samples to a vector of token counts.
         */
        $vectorizer = new TokenCountVectorizer(new WordTokenizer());

        /**
         *  is a numerical statistic that is intended to reflect how important a word is
         * to a document in a collection.
         */
        $tfIdfTransformer = new TfIdfTransformer();

        /**
         * array to each sentence and its label
         */
        $samples = [];
        foreach ($dataset->getSamples() as $sample) {
            $samples[] = $sample[0];
        }
        /**
         * show the frecuencie that each word in the sentence
         */
        $vectorizer->fit($samples);
        $vectorizer->transform($samples);

        /**
         * show the frecuencie but in numbers
         */
        $tfIdfTransformer->fit($samples);
        $tfIdfTransformer->transform($samples);

        $dataset = new ArrayDataset($samples, $dataset->getTargets());
        /**
         * split to two groups, train group and test group
         * first paramenter is the dataset
         * second parameter is the fration of test
         */
        $randomSplit = new StratifiedRandomSplit($dataset, 0.1);
        // $classifier = new SVC(Kernel::RBF, 10000);
        // $classifier->train($randomSplit->getTrainSamples(), $randomSplit->getTrainLabels());
        // dd($classifier);

        $mlp = new MLPClassifier(4, [2], [ 'pregunta','respuesta']);
        // dd($randomSplit->getTrainSamples());
        $mlp->train(
            $samples = [ $randomSplit->getTrainSamples()[0],
                         $randomSplit->getTrainSamples()[1],
                         $randomSplit->getTrainSamples()[2],
                         $randomSplit->getTrainSamples()[3],
                         $randomSplit->getTrainSamples()[4],
                         $randomSplit->getTrainSamples()[5],
                         $randomSplit->getTrainSamples()[6],
                         $randomSplit->getTrainSamples()[7],
                         $randomSplit->getTrainSamples()[8],
                         $randomSplit->getTrainSamples()[9],
                         $randomSplit->getTrainSamples()[10],
                         $randomSplit->getTrainSamples()[11],
                         $randomSplit->getTrainSamples()[12],
                         $randomSplit->getTrainSamples()[13],
                         $randomSplit->getTrainSamples()[14],
                         $randomSplit->getTrainSamples()[15],
                         $randomSplit->getTrainSamples()[16],
                         $randomSplit->getTrainSamples()[17],
                         $randomSplit->getTrainSamples()[18],
                         $randomSplit->getTrainSamples()[19],
                         $randomSplit->getTrainSamples()[20],
                         $randomSplit->getTrainSamples()[21],
                    ],
            $targets = [ $randomSplit->getTrainLabels()[0],
                         $randomSplit->getTrainLabels()[1],
                         $randomSplit->getTrainLabels()[2],
                         $randomSplit->getTrainLabels()[3],
                         $randomSplit->getTrainLabels()[4],
                         $randomSplit->getTrainLabels()[5],
                         $randomSplit->getTrainLabels()[6],
                         $randomSplit->getTrainLabels()[7],
                         $randomSplit->getTrainLabels()[8],
                         $randomSplit->getTrainLabels()[9],
                         $randomSplit->getTrainLabels()[10],
                         $randomSplit->getTrainLabels()[11],
                         $randomSplit->getTrainLabels()[12],
                         $randomSplit->getTrainLabels()[13],
                         $randomSplit->getTrainLabels()[14],
                         $randomSplit->getTrainLabels()[15],
                         $randomSplit->getTrainLabels()[16],
                         $randomSplit->getTrainLabels()[17],
                         $randomSplit->getTrainLabels()[18],
                         $randomSplit->getTrainLabels()[19],
                         $randomSplit->getTrainLabels()[20],
                         $randomSplit->getTrainLabels()[21],
                    ]
        );

        $predictLabels = $mlp->predict( $randomSplit->getTestSamples() );

        return $predictLabels;
    }
}
